<?php

use App\Timeline;
use App\Trip;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToPlacesTripsPivotTableStep2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Schema::connection('tenant')
            ->table('places_trips', function (Blueprint $table) {
                $table->integer('trip_id')->unsigned()->change();
                $table->integer('place_id')->unsigned()->change();

                $table->unique(['trip_id','place_id','type']);
            });
        
        if (!$this->checkIfAForeignKeyExists('places_trips','places_trips_trip_id_foreign')) {
            Schema::table('places_trips', function (Blueprint $table) {
                $table->foreign('trip_id')
                    ->on('trips')
                    ->references('id')
                    ->onDelete('cascade');
            });
        }

        if (!$this->checkIfAForeignKeyExists('places_trips','places_trips_place_id_foreign')) {
            Schema::table('places_trips', function (Blueprint $table) {
                $table->foreign('place_id')
                    ->on('places')
                    ->references('id');

            });
        }


        DB::statement('SET FOREIGN_KEY_CHECKS=1');

    }

    public function checkIfAForeignKeyExists($table, $foreign_key)
    {
        $foreignKeys = $this->listTableForeignKeys($table);
        return in_array($foreign_key, $foreignKeys) ;
    }

    public function listTableForeignKeys($table)
    {
        $conn = Schema::getConnection()->getDoctrineSchemaManager();

        return array_map(function($key) {
            return $key->getName();
        }, $conn->listTableForeignKeys($table));
    }
}

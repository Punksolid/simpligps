<?php
namespace App\Migrations\Tenant;


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeOptionalFieldsToNullableinTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        if ($this->checkIfAForeignKeyExists('trips','trips_truck_tract_id_foreign')) {
            Schema::table('trips', function (Blueprint $table) {
                $table->dropForeign('trips_truck_tract_id_foreign');

            });
        }

        if ($this->checkIfAForeignKeyExists('trips','trips_carrier_id_foreign')) {
            Schema::table('trips', function (Blueprint $table) {
                $table->dropForeign('trips_carrier_id_foreign');
            });
        }
        if ($this->checkIfAForeignKeyExists('trips','trips_operator_id_foreign')) {
            Schema::table('trips', function (Blueprint $table) {
                $table->dropForeign('trips_operator_id_foreign');

            });
        }

        if ($this->checkIfAForeignKeyExists('trips','trips_device_id_foreign')) {
            Schema::table('trips', function (Blueprint $table) {
                $table->dropForeign('trips_device_id_foreign');
            });

        }

        Schema::table('trips', function (Blueprint $table) {

            $table->integer('truck_tract_id')->nullable()->change();
            $table->integer('carrier_id')->nullable()->change();
            $table->integer('operator_id')->nullable()->change();

            $table->dropColumn('device_id');

        });

        DB::statement('SET FOREIGN_KEY_CHECKS=1');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trips', function (Blueprint $table) {
            //
        });
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

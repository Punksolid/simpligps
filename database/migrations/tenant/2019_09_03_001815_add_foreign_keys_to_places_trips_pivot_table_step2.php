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

        Schema::connection('tenant')
        ->table('places_trips', function (Blueprint $table) {
            $table->integer('trip_id')->unsigned()->change();
            $table->integer('place_id')->unsigned()->change();
            $table->foreign('trip_id')->on('trips')->references('id')
                ->onDelete('cascade');
            $table->foreign('place_id')->on('places')->references('id');

            $table->unique(['trip_id','place_id','type']);
        });
    }

}

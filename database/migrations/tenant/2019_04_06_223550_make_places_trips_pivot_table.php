<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakePlacesTripsPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('places_trips', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('trip_id');
            $table->integer('place_id');
            $table->integer('order');
            $table->enum('type',['origin','intermediate','destination']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('places_trips');
    }
}

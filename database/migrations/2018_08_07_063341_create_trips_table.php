<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->increments('id');

            $table->string("rp")->nullable();
            $table->string("invoice")->nullable();
            $table->string("client")->nullable();
            $table->string("intermediary")->nullable();
            $table->string("origin")->nullable();
            $table->string("destination")->nullable();
            $table->string("mon_type")->nullable();
            $table->string("line")->nullable();

            $table->dateTime("scheduled_load")->nullable();
            $table->dateTime("scheduled_departure")->nullable();
            $table->dateTime("scheduled_arrival")->nullable();
            $table->dateTime("scheduled_unload")->nullable();

            $table->text("bulk")->nullable();

            //operational
            $table->string("tag")->nullable();
            $table->integer("convoy_id")->nullable();
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
        Schema::dropIfExists('trips');
    }
}

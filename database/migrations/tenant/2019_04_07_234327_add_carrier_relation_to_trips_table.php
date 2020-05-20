<?php

 /** @noinspection PhpUndefinedClassInspection */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCarrierRelationToTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('trips', function (Blueprint $table) {

            $table->unsignedBigInteger('carrier_id')->nullable();
            $table->dropColumn('line');

        });

        Schema::table('trips', function (Blueprint $table) {

            $table->bigInteger('origin_id')->unsigned()->change();
        });

        Schema::table('trips', function (Blueprint $table) {

            $table->bigInteger('destination_id')->unsigned()->change();
            $table->bigInteger('device_id')->unsigned()->change();
        });

        Schema::table('trips', function (Blueprint $table) {

            $table->foreign('origin_id')->references('id')->on('places');
            $table->foreign('destination_id')->references('id')->on('places');

        });

        Schema::table('trips', function (Blueprint $table) {

            $table->foreign('carrier_id')->references('id')->on('carriers');

        });

        Schema::table('trips', function (Blueprint $table) {

            $table->foreign('device_id')->references('id')->on('devices');

        });
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
}

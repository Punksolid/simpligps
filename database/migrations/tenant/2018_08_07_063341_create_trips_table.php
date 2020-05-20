<?php
namespace App\Migrations\Tenant;


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');

            $table->string("rp")->nullable();
            $table->string("invoice")->nullable();
            $table->string("client")->nullable();
            $table->json("intermediary")->nullable();

            $table->bigInteger("origin_id")
                ->nullable();

            $table->bigInteger("destination_id")
                ->nullable();

            $table->string("mon_type")->nullable();
            $table->string("line")->nullable();

            $table->dateTime("scheduled_load")->nullable();
            $table->dateTime("scheduled_departure")->nullable();
            $table->dateTime("scheduled_arrival")->nullable();
            $table->dateTime("scheduled_unload")->nullable();

            $table->text("bulk")->nullable();

            //operational
            $table->string("tag")->nullable();
            $table->integer("device_id")->nullable();
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

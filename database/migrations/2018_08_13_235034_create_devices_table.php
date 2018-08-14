<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('plate')->nullable();
            $table->string('internal_number')->nullable();
            $table->string('color')->nullable();
            $table->string('brand')->nullable();
            $table->string('gps')->nullable();
            $table->string('model')->nullable();
            $table->integer('wialon_id')->nullable();
            $table->string('line')->nullable();
            $table->integer('group_id')->nullable();

            $table->text("bulk")->nullable();
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
        Schema::dropIfExists('devices');
    }
}

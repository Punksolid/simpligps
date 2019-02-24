<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;



class CreateCarrierTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carriers', function (Blueprint $table) {
            $table->increments('id');
            $table->string("carrier_name");
            $table->string("contact_name");
            $table->string("phone");
            $table->string("email");
            $table->text("bulk")->nullable(); //TODO cambiar a Json
            $table->timestamps();
        });
        Schema::table("operators", function (Blueprint $table){
            $table->unsignedInteger('carrier_id')->nullable();
            $table->foreign('carrier_id')->references('id')->on('carriers');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carriers');
    }
}

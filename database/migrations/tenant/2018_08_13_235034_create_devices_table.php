<?php



use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->string('plate')->nullable();
            $table->string('internal_number')->nullable();
            $table->string('color')->nullable();
            $table->string('brand')->nullable();
            $table->string('gps')->nullable();
            $table->string('model')->nullable();
            $table->integer('wialon_id')->nullable();
            $table->integer('carrier_id')->nullable();

            $table->integer('group_id')->nullable();

            $table->json("bulk")->nullable();
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

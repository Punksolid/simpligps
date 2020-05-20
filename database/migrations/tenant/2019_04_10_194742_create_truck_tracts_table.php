<?php



use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTruckTractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('truck_tracts', function (Blueprint $table) {
            $table->bigIncrements('id');
                $table->string('plate');
                $table->string('model');
                $table->string('internal_number');
                $table->string('brand');
                $table->string('gps');
                $table->bigInteger('carrier_id')->unsigned()->nullable();
                $table->bigInteger('device_id')->unsigned()->nullable();
                $table->string('color');
            $table->timestamps();
        });

        Schema::table('truck_tracts', function (Blueprint $table) {
            $table->foreign('carrier_id')->references('id')->on('carriers');
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
        Schema::dropIfExists('truck_tracts');
    }
}

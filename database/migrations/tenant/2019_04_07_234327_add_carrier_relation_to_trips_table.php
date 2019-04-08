<?php /** @noinspection PhpUndefinedClassInspection */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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

            $table->integer('carrier_id')->unsigned()->nullable();
            $table->dropColumn('line');

        });

        Schema::table('trips', function (Blueprint $table) {

            $table->integer('origin_id')->unsigned()->change();
            $table->integer('destination_id')->unsigned()->change();
            $table->integer('device_id')->unsigned()->change();
        });

        Schema::table('trips', function (Blueprint $table) {

            $table->foreign('origin_id')->references('id')->on('places');
            $table->foreign('destination_id')->references('id')->on('places');
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
        Schema::table('trips', function (Blueprint $table) {
            //
        });
    }
}

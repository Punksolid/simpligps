<?php
namespace App\Migrations\Tenant;


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTruckTractRelationshipToTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('trips','truck_tract_id')){
            Schema::table('trips', function (Blueprint $table) {
                $table->bigInteger('truck_tract_id')->unsigned();
            });

            Schema::table('trips', function (Blueprint $table){
                $table->foreign('truck_tract_id')->references('id')->on('truck_tracts');
            });
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trips', function (Blueprint $table) {
            $table->dropColumn('truck_tract_id');
        });
    }
}

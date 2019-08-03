<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPolimorphismToDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('devices','deviceable_type')){
            Schema::table('devices', function (Blueprint $table) {
                $table->nullableMorphs('deviceable');
            });
        }



        Schema::table('truck_tracts', function (Blueprint $table){
            $table->dropForeign('truck_tracts_device_id_foreign');
            $table->dropColumn('device_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('devices', function (Blueprint $table) {
            $table->dropMorphs('deviceable');
        });
        Schema::table('truck_tracts', function (Blueprint $table) {
           $table->unsignedBigInteger('device_id');
        });
    }
}

<?php
namespace App\Migrations\Tenant;


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropPlateAndCarrierIdColumnFromDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('devices','carrier_id')){
            Schema::table('devices', function (Blueprint $table) {
                $table->dropColumn('carrier_id');
                $table->dropColumn('plate');
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
        Schema::table('devices', function (Blueprint $table) {
            //
        });
    }
}

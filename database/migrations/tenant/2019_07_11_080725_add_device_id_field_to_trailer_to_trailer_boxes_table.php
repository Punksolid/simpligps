<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDeviceIdFieldToTrailerToTrailerBoxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('trailer_boxes','device_id')){
            Schema::table('trailer_boxes', function (Blueprint $table) {
                $table->unsignedBigInteger('device_id')->nullable();
                $table->foreign('device_id')->references('id')->on('devices');
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
//        if (Schema::hasColumn('trailer_boxes','trailer_boxes_device_id_foreign')){
//            Schema::table('trailer_boxes', function (Blueprint $table) {
//                $table->dropForeign('trailer_boxes_device_id_foreign');
//                $table->dropColumn('device_id');
//            });
//        }
    }
}

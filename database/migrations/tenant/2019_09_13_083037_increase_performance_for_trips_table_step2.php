<?php
namespace App\Migrations\Tenant;


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class IncreasePerformanceForTripsTableStep2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trips', function (Blueprint $table) {
            // Drop unused indexes
            $table->dropIndex('trips_origin_id_foreign');
            $table->dropIndex('trips_destination_id_foreign');
            /// Drop unused columns
          //Drop unused columns ORIGIN_ID DESTINATION_ID INTERMEDIARY
            $table->dropColumn([
               'origin_id',
               'destination_id',
               'intermediary'
            ]);

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

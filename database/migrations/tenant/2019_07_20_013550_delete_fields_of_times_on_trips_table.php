<?php



use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteFieldsOfTimesOnTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('trips','scheduled_departure')){
            Schema::table('trips', function (Blueprint $table) {
                $table->dropColumn('scheduled_departure');
                $table->dropColumn('scheduled_arrival');
                $table->dropColumn('scheduled_load');
                $table->dropColumn('scheduled_unload');
                $table->dropColumn('real_departure');
                $table->dropColumn('real_arrival');
                $table->dropColumn('bulk');
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
            //
        });
    }
}

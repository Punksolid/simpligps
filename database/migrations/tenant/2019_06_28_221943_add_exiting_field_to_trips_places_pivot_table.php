<?php



use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExitingFieldToTripsPlacesPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('places_trips','exiting')){
            Schema::table('places_trips', function (Blueprint $table) {
                $table->dateTime('exiting')->nullable();
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
        Schema::table('places_trips', function (Blueprint $table) {
            //
        });
    }
}

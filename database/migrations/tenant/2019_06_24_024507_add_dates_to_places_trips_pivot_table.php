<?php
namespace App\Migrations\Tenant;


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDatesToPlacesTripsPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumn('places_trips','at_time')){
            Schema::table('places_trips', function (Blueprint $table) {
                $table->dateTime('at_time')->nullable();
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

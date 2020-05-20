<?php
namespace App\Migrations\Tenant;


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRealDepartureAndArrivalDateToTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('trips','real_departure')){
            Schema::table('trips', function (Blueprint $table) {
                $table->dateTime('real_departure')->nullable();
                $table->dateTime('real_arrival')->nullable();
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

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MoveOperatorIdFieldFromTrucksToTrips extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('truck_tracts', 'operator_id')) {
            Schema::table('truck_tracts', function (Blueprint $table) {
                $table->dropForeign('truck_tracts_operator_id_foreign');
                $table->dropColumn('operator_id');
            });
        }

        if (!Schema::hasColumn('trips', 'operator_id')) {
            Schema::table('trips', function (Blueprint $table) {
                $table->integer('operator_id')->unsigned();
                $table->foreign('operator_id')->references('id')->on('operators');
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
        Schema::table('truck_tracts', function (Blueprint $table) {
            $table->integer('operator_id');
        });

        Schema::table('trips', function (Blueprint $table) {
            $table->dropColumn('operator_id');
        });
    }
}

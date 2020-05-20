<?php
namespace App\Migrations\Tenant;


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MoveOperatorIdFieldFromTrucksToTrips extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        if (Schema::hasColumns('truck_tracts', ['operator_id', 'truck_tracts_operator_id_foreign'])) {
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
        Schema::enableForeignKeyConstraints();
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

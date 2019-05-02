<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeClientFieldToClientIdInTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if (Schema::hasColumn('trips', 'client')) {
            Schema::table('trips', function (Blueprint $table) {
                $table->dropColumn('client');

            });
        }

        if (!Schema::hasColumn('trips','client_id')) {
            Schema::table('trips', function (Blueprint $table) {
                $table->bigInteger('client_id')->unsigned()->nullable();
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

        });
    }
}

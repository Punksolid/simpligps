<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLicensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('licenses', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name");
            $table->string("description");

            $table->integer("lapse");
            $table->text("modules");
            $table->integer("units");
            $table->integer("number_active_sessions");

            $table->uuid("uuid");
            $table->timestamps();
        });

        Schema::create("licenses_accounts", function(Blueprint $table) {
           $table->increments("id");
           $table->integer("account_id");
           $table->integer("license_id");
           $table->dateTime("expires_at");
           $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('licenses');
    }
}

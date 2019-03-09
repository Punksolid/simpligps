<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSoftDeleteToAccountstable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->softDeletes();
            $table->string('managed_by_database_connection')
                ->nullable()
                ->comment('References the database connection key in your database.php');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn("accounts", "deleted_at")){
            Schema::table("accounts", function (Blueprint $table) {
                $table->dropColumn("deleted_at");
                $table->dropColumn("managed_by_database_connection");
            });
        }
        if (Schema::hasColumn("accounts", "deleted_at")){
            Schema::table("accounts", function (Blueprint $table) {
                $table->dropColumn("deleted_at");
            });
        }

    }
}

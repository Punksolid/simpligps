<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropUsernameColumnFromProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('users','lastname')) {
            Schema::table('users', function (Blueprint $table){
                $table->string('lastname');
            });

            $users = \App\User::all();
            foreach ($users as $user) {
                $user->lastname = $user->profile->lastname;
                $user->save();
            }
            Schema::drop('profiles');
        }



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->string('username');
        });

    }
}

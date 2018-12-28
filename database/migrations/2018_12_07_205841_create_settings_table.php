<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key');
            $table->string('value');
            $table->boolean('can_be_null')->default(true);
            $table->integer('max_value')->nullable();
            $table->integer('min_value')->nullable();

            $table->string('description');
            $table->timestamps();
        });

        DB::table('settings')->insert([
            'key' => 'wialon_key',
            'value' => '',
            'can_be_null' => true,
            'description' => 'Wialon Access API Key'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}

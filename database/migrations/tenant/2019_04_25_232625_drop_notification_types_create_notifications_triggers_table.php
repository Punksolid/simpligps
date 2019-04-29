<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropNotificationTypesCreateNotificationsTriggersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('notification_types');

        if (!Schema::hasTable('notification_triggers')) {
            Schema::create('notification_triggers', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name');
                $table->string('control_type')->default('generic');
                $table->json('control_type_obj')->nullable();
                $table->string('level')->default(' alert-light');
                $table->boolean('active');

                $table->string('wialon_id')->nullable(); // wialon resource referencia
                $table->json('audit_obj')->nullable(); // wialon o objeto devuelto con drivers de cualquier plataforma

                $table->softDeletes();
                $table->timestamps();
            });
        }


        Schema::create('notification_triggers_devices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('notification_trigger_id')->unsigned();
            $table->integer('device_id')->unsigned(); // @todo cambiar a BigInteger de ser posible
            $table->foreign('notification_trigger_id')->references('id')->on('notification_triggers');
            $table->foreign('device_id')->references('id')->on('devices');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('notification_triggers');
        Schema::dropIfExists('notification_triggers_devices');
        Schema::enableForeignKeyConstraints();
    }
}

<?php



use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string("alias")->unique();
            $table->enum("level",["danger","warning","attention", "info", "log"])->default("log");
            $table->boolean("active")->default(true);
            $table->enum("deactivation_mode", ["implicit","explicit","both"])->default("both");
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
        Schema::dropIfExists('notification_types');
    }
}

<?php



use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPsrLogColumnsToLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    

        Schema::table('logs', function (Blueprint $table) {
            $table->string("message")->nullable();
            $table->renameColumn('level','level_name');
            $table->renameColumn('data','context');
            $table->string('channel')->default('general');
            $table->dateTime('datetime')->nullable();
            $table->json('extra')->nullable();

        });

        Schema::table('logs', function (Blueprint $table) {
            $table->unsignedInteger('level');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('log', function (Blueprint $table) {
            //
        });
    }
}

<?php



use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeBrandFieldToNullableInTrucksTractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('truck_tracts', function (Blueprint $table) {
            $table->string('plate')->nullable()->change();
            $table->string('model')->nullable()->change();
            $table->string('internal_number')->nullable()->change();
            $table->string('brand')->nullable()->change();
            $table->string('gps')->nullable()->change();
            $table->string('color')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('truck_tracts', function (Blueprint $table) {
            $table->string('plate')->change();
            $table->string('model')->change();
            $table->string('internal_number')->change();
            $table->string('brand')->change();
            $table->string('gps')->change();
            $table->string('color')->change();
        });
    }
}

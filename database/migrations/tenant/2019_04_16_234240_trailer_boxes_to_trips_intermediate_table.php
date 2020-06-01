<?php



use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TrailerBoxesToTripsIntermediateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trailer_boxes_trips', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->foreignId('trailer_box_id');
            $table->foreignId('trip_id');
            $table->tinyInteger('order')->nullable();
            $table->timestamps();
        });

        Schema::table('trailer_boxes_trips', function (Blueprint $table) {
            $table->foreign('trailer_box_id')->references('id')->on('trailer_boxes');
            $table->foreign('trip_id')->references('id')->on('trips');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trailer_boxes_trips');
    }
}

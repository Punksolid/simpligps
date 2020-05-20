<?php



use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrailerBoxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trailer_boxes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('plate');
            $table->string('internal_number');
            $table->string('gps');
            $table->unsignedBigInteger('carrier_id')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('trailer_boxes', function (Blueprint $table){
            $table->foreign('carrier_id')->references('id')->on('carriers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trailer_boxes');
    }
}

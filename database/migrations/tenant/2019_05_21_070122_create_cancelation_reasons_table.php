<?php



use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCancelationReasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cancelation_reasons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 50); // Si desean refactorizar podrían empezar por eliminar esta table al igual que la de situations
            // complejidad innecesaria de momento.
            $table->softDeletes();
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
        Schema::dropIfExists('cancelation_reasons');
    }
}

<?php

use App\Timeline;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToPlacesTripsPivotTable extends Migration
{
    /**
     * Se deshace del campo enum por no ser estandar y dar mas problemas de los que resuelve
     * paso siguiente se agregan indices y llaves foraneas
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('tenant')
        ->table('places_trips', function (Blueprint $table) {
            $table->string('type_in_string')->nullable()->after('type');

        });
        $checkpoints = Timeline::get();
        foreach ($checkpoints as $checkpoint) {
            $checkpoint->type_in_string = $checkpoint->type;
            $checkpoint->save();
        }

        Schema::table('places_trips', function (Blueprint $table) {
           $table->dropColumn('type');
        });

        Schema::table('places_trips', function (Blueprint $table) {
           $table->renameColumn('type_in_string','type');
        });
    }


}

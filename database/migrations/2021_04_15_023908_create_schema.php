<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchema extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shps', function (Blueprint $table) {
            $table->foreign('id_rencana')->references('id')
                ->on('rencanas')->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('id_alias')->references('id')
                ->on('aliases')->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('datashps', function (Blueprint $table) {
            $table->foreign('id_shp')->references('id')
                ->on('shps')->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schema');
    }
}

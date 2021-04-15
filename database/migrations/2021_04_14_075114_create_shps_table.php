<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shps', function (Blueprint $table) {
            $table->increments('id');
            $table->string('register')->unique();
            $table->string('peta');
            $table->text('keluaran');
            $table->integer('id_rencana')->unsigned();
            $table->text('sumber_dokumen');
            $table->string('jenis_data');
            $table->integer('id_alias')->unsigned();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned();
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
        Schema::dropIfExists('shps');
    }
}

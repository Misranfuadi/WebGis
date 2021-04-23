<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatashpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datashps', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_shp')->unsigned();
            $table->text('note')->nullable();
            $table->enum('status', ['0', '1', '2'])->default('0');
            $table->string('data_shp');
            $table->string('data_size', 100);
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned()->nullable();
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
        Schema::dropIfExists('datashps');
    }
}

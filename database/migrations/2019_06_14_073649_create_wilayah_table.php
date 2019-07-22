<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWilayahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wilayah', function (Blueprint $table) {
            $table->increments('wilayah_id')->unique();
            $table->integer('area_id')->unsigned();
            $table->string('nama_wilayah');
            $table->timestamps();
        });
        Schema::table('wilayah', function($table)
        {
            $table->foreign('area_id')
                ->references('area_id')
                ->on('area')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wilayah');
    }
}

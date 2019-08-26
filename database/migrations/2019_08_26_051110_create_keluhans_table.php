<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeluhansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keluhan', function (Blueprint $table) {
            $table->increments('id_keluhan')->unique();
            $table->string('kode_customer');
            $table->string('spv_pic');
            $table->date('tanggal_keluhan');
            $table->time('jam_keluhan');
            $table->string('keluhan');
            $table->string('pic');
            $table->time('jam_follow');
            $table->string('follow_up');
            $table->string('closing_case');
            $table->string('via');
            $table->string('status');
            $table->timestamps();
        });
        Schema::table('keluhan', function($table)
        {
            $table->foreign('kode_customer')
                ->references('kode_customer')
                ->on('customer')
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
        Schema::dropIfExists('keluhan');
    }
}

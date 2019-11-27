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
            $table->string('departemen');
            $table->date('tanggal_keluhan');
            $table->string('topik_masalah');
            $table->string('saran_penyelesaian');
            $table->date('time_target');
            $table->date('confirm_pic');
            $table->string('case');
            $table->date('actual_case');
            $table->string('uraian_penyelesaian');
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

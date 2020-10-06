<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKontrakTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kontrak', function (Blueprint $table) {
            $table->increments('id_kontrak')->unique();
            $table->string('nomor_kontrak');
            $table->string('kode_customer');
            $table->foreign('kode_customer')
                ->references('kode_customer')
                ->on('customer')
                ->onDelete('cascade');
            // $table->string('no_adendum')
            $table->date('periode_kontrak');
            $table->date('akhir_periode');
            $table->string('srt_pemberitahuan');
            $table->date('tgl_srt_pemberitahuan');
            $table->string('srt_penawaran');
            $table->date('tgl_srt_penawaran');
            $table->string('dealing');
            $table->date('tgl_dealing');
            $table->string('posisi_pks');
            $table->string('closing');
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
        Schema::dropIfExists('kontrak');
    }
}

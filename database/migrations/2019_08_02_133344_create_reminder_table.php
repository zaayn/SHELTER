<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReminderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reminder', function (Blueprint $table) {
            $table->string('id_kontrak')->unique();
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
        Schema::dropIfExists('reminder');
    }
}

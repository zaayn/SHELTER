<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatamousTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datamou', function (Blueprint $table) {
            $table->increments('no_mou')->unique();
            $table->integer('id_kontrak')->unsigned();
            $table->string('nomor_kontrak');
            $table->integer('hc');
            $table->integer('invoice');
            $table->integer('mf');
            $table->integer('mf_persen');
            $table->string('bpjs_tk_persen')->nullable();
            $table->string('bpjs_tenagakerja')->nullable();
            $table->string('bpjs_kes_persen')->nullable();
            $table->string('bpjs_kesehatan')->nullable();
            $table->string('jiwasraya')->nullable();
            $table->string('ramamusa')->nullable();
            $table->string('ditagihkan')->nullable();
            $table->string('diprovisasikan')->nullable();
            $table->string('overheadcost');
            $table->string('training');
            $table->string('tanggal_invoice');
            $table->string('time_of_payment');
            $table->string('cut_of_date');
            $table->string('kaporlap');
            $table->string('devices');
            $table->string('chemical');
            $table->string('pendaftaran_mou');
            $table->timestamps();
        });
        Schema::table('datamou', function($table)
        {
            $table->foreign('id_kontrak')
                ->references('id_kontrak')
                ->on('kontrak')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('datamous');
    }
}

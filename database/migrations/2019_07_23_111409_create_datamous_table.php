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
        Schema::create('datamous', function (Blueprint $table) {
            $table->increments('no_mou');
            $table->integer('id_kontrak');
            $table->integer('hc');
            $table->string('invoice');
            $table->date('mf');
            $table->string('mf_persen');
            $table->date('bpjs_tenagakerja');
            $table->string('bpjs_kesehatan');
            $table->date('jiwasraya');
            $table->string('ramamusa');
            $table->date('ditagihkan');
            $table->string('diprovisasikan');
            $table->string('overheadcost');
            $table->string('training');
            $table->date('tanggal_invoice');
            $table->string('time_of_payment');
            $table->date('cut_of_date');
            $table->string('kaporlap');
            $table->string('devices');
            $table->string('chemical');
            $table->string('pendaftaran_mou');
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
        Schema::dropIfExists('datamous');
    }
}

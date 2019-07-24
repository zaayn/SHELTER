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
            $table->increments('no_mou');
            $table->integer('id_kontrak');
            $table->integer('hc');
            $table->integer('invoice');
            $table->integer('mf');
            $table->integer('mf_persen');
            $table->string('bpjs_tenagakerja');
            $table->string('bpjs_kesehatan');
            $table->string('jiwasraya');
            $table->string('ramamusa');
            $table->string('ditagihkan');
            $table->string('diprovisasikan');
            $table->string('overheadcost');
            $table->string('training');
            $table->date('tanggal_invoice');
            $table->date('time_of_payment');
            $table->string('cut_of_date');
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

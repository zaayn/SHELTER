<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visit', function (Blueprint $table) {
            $table->increments('visit_id')->unique();
            $table->string('kode_customer');
            $table->string('spv_pic');
            $table->date('tanggal_visit');
            $table->time('waktu_in');
            $table->time('waktu_out');
            $table->string('pic_meeted');
            $table->string('kegiatan');
            $table->timestamps();
        });
        Schema::table('visit', function($table)
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
        Schema::dropIfExists('visit');
    }
}

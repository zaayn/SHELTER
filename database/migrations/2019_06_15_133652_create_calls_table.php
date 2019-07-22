<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('call', function (Blueprint $table) {
            $table->increments('call_id');
            $table->string('nama_customer');
            $table->string('spv_pic');
            $table->datetime('tanggal_call');
            $table->time('jam_call');
            $table->string('pembicaraan');
            $table->string('pic_called');
            $table->string('hal_menonjol');
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
        Schema::dropIfExists('call');
    }
}

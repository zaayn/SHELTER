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
            $table->increments('call_id')->unique();
            $table->string('kode_customer');
            $table->date('tanggal_call');
            $table->time('jam_call');
            $table->longText('pembicaraan');
            $table->string('pic_called');
            $table->longText('hal_menonjol');
            $table->timestamps();
        });
        Schema::table('call', function($table)
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
        Schema::dropIfExists('call');
    }
}

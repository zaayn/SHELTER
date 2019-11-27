<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->string('kode_customer')->unique();
            $table->string('nama_perusahaan');
            $table->string('jenis_usaha');
            $table->integer('bu_id')->unsigned();
            $table->string('alamat');
            $table->string('provinsi');
            $table->string('kabupaten');
            $table->string('telpon');
            $table->string('fax');
            $table->string('cp');
            $table->integer('area_id')->unsigned();
            $table->string('nama_depan');
            $table->string('status');
            $table->integer('month_kontrak')->default(0);
            $table->string('jenis_perusahaan');
            $table->string('negara');
            $table->string('putus_kontrak')->nullable();
            $table->timestamps();
        });
        Schema::table('customer', function($table)
        {
            $table->foreign('area_id')
                ->references('area_id')
                ->on('area')
                ->onDelete('cascade');
        });
        Schema::table('customer', function($table)
        {
            $table->foreign('bu_id')
                ->references('bu_id')
                ->on('bisnis_unit')
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
        Schema::dropIfExists('customer');
    }
}

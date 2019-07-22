<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('username');
            $table->string('nama_depan');
            $table->string('nama_belakang');
            $table->string('email')->unique();
            $table->integer('wilayah_id')->unsigned();
            $table->string('no_hp');
            $table->string('password');
            // $table->string('nama_area');
            $table->string('rule');
            $table->rememberToken();
            $table->timestamps();
        });
        Schema::table('users', function($table)
        {
            $table->foreign('wilayah_id')
                ->references('wilayah_id')
                ->on('wilayah')
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
        Schema::dropIfExists('users');
    }
}

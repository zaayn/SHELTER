<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRowsToDatamous extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('datamou', function (Blueprint $table) {
            $table->string('bpjs_tk_persen')->after('mf_persen')->nullable();
            $table->string('bpjs_kes_persen')->after('bpjs_tenagakerja')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('datamou', function (Blueprint $table) {
            $table->dropColumn('bpjs_tk_persen');
            $table->dropColumn('bpjs_kes_persen');
        });
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kontrak extends Model
{
    protected $table = 'kontrak';
    protected $primaryKey = 'id_kontrak';
    protected $fillable = [
        'kode_customer'
       ,'periode_kontrak'
       ,'akhir_periode'
       ,'srt_pemberitahuan'
       ,'tgl_srt_pemberitahuan'
       ,'srt_penawaran'
       ,'tgl_srt_penawaran'
       ,'dealing'
       ,'tgl_dealing'
       ,'posisi_pks'
       ,'closing'
    ];

    public function customer()
    {
        return $this->belongsTo(\App\Customer::class,'kode_customer','kode_customer');
    }
}

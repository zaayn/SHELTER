<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class datamou extends Model
{
    protected $table = 'datamou';
    protected $primaryKey = 'no_mou';
    protected $fillable = [
       'id_kontrak'
       ,'hc'
       ,'invoice'
       ,'mf'
       ,'mf_persen'
       ,'bpjs_tk_persen'
       ,'bpjs_tenagakerja'
       ,'bpjs_kes_persen'
       ,'bpjs_kesehatan'
       ,'jiwasraya'
       ,'ramamusa'
       ,'ditagihkan'
       ,'diprovisasikan'
       ,'overheadcost'
       ,'training'
       ,'tanggal_invoice'
       ,'time_of_payment'
       ,'cut_of_date'
       ,'kaporlap'
       ,'devices'
       ,'chemical'
       ,'pendaftaran_mou'
    ];

    public function kontrak()
    {
        return $this->belongsTo(\App\kontrak::class, 'id_kontrak', 'id_kontrak');
    }
}

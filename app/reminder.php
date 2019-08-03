<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class reminder extends Model
{
    protected $table = 'reminder';
    protected $primaryKey = 'id_kontrak';
    protected $fillable = [
       'periode_kontrak'
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
}

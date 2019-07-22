<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class call extends Model
{
    protected $table = 'call';
    protected $primaryKey = 'call_id';
    protected $fillable = [
        'nama_customer'
       ,'spv_pic'
       ,'tanggal_call'
       ,'jam_call'
       ,'pembicaraan'
       ,'pic_called'
       ,'hal_menonjol'
    ];
}

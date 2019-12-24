<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class keluhan extends Model
{
    protected $table = 'keluhan';
    protected $primaryKey = 'id_keluhan';
    protected $fillable = [
        'departemen'
       ,'tanggal_keluhan'
       ,'topik_masalah'
       ,'saran_penyelesaian'
       ,'time_target'
       ,'confirm_pic'
       ,'case'
       ,'actual_case'
       ,'uraian_penyelesaian'
       ,'status'
    ];
    public function customer()
    {
        return $this->belongsTo(\App\Customer::class,'kode_customer','kode_customer');
    }
}

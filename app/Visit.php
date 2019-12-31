<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class visit extends Model
{
    protected $table = 'visit';
    protected $primaryKey = 'visit_id';
    protected $fillable = [
        'spv_pic'
       ,'tanggal_visit'
       ,'waktu_in'
       ,'waktu_out'
       ,'pic_meeted'
       ,'kegiatan'
    ];
    public function customer()
    {
        return $this->belongsTo(\App\Customer::class,'kode_customer','kode_customer');
    }
}

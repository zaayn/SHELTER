<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class keluhan extends Model
{
    protected $table = 'keluhan';
    protected $primaryKey = 'id_keluhan';
    protected $fillable = [
        'nama_customer'
       ,'spv_pic'
       ,'tanggal_keluhan'
       ,'jam_keluhan'
       ,'keluhan'
       ,'pic'
       ,'jam_follow'
       ,'follow_up'
       ,'closing_case'
       ,'via'
       ,'status'
    ];
    public function customer()
    {
        return $this->belongsTo(\App\Customer::class,'kode_customer','kode_customer');
    }
}

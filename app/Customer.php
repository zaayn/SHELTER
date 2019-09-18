<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer';
    protected $primaryKey = 'kode_customer';
    protected $fillable = [
        'nama_perusahaan'
       ,'jenis_usaha'
       ,'bu_id'
       ,'alamat'
       ,'provinsi'
       ,'kabupaten'
       ,'telpon'
       ,'fax'
       ,'cp'
       ,'nama_area'
       ,'wilayah_id'
       ,'nama_depan'
       ,'status'
       ,'month_kontrak'
       ,'jenis_perusahaan'
       ,'negara'
       
    ];
    public $incrementing = false;
    protected $appends = ['customer_type'];

    public function wilayah()
    {

        return $this->belongsTo(\App\Wilayah::class,'wilayah_id','wilayah_id');

    }
    public function bisnis_unit()
    {

        return $this->belongsTo(\App\Bisnis_unit::class,'bu_id','bu_id');

    }
    public function kontrak()
    {

        return $this->hasMany(\App\Kontrak::class);

    }
    public function call()
    {

        return $this->hasMany(\App\Call::class);

    }
    public function visit()
    {
        return $this->hasMany(\App\Visit::class);
    }
    public function keluhan()
    {
        return $this->hasMany(\App\Keluhan::class);
    }
    
    public function getCustomerTypeAttribute()
    {
        if($this->month_kontrak < 24)
        {
            return "Silver";
        }

        elseif($this->month_kontrak >= 24 && $this->month_kontrak < 60)
        {
          return "Gold";
        }
        elseif($this->month_kontrak >= 60)
        {
          return "Platinum";
        }
    }
}

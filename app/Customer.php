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
       
    ];
    public $incrementing = false;

    public function wilayah()
    {

        return $this->belongsTo(\App\Wilayah::class,'wilayah_id','wilayah_id');

    }
    public function bisnis_unit()
    {

        return $this->belongsTo(\App\bisnis_unit::class,'bu_id','bu_id');

    }
    public function kontrak()
    {

        return $this->hasMany(kontrak::class);

    }
}

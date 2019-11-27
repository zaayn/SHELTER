<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class wilayah extends Model
{
    protected $table = 'wilayah';
    protected $primaryKey = 'wilayah_id';
    protected $fillable = [
        'area_id'
       ,'nama_wilayah'
       ,'created_at'
       ,'updated_at'
    ];

    public function area()
    {
        return $this->belongsTo(\App\Area::class,'area_id','area_id');
    }
    public function user()
    {

        return $this->hasMany(\App\User::class);

    }
    public function customer()
    {

        return $this->hasMany(\App\customer::class);

    }
}

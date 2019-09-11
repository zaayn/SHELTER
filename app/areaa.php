<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class area extends Model
{
    protected $table = 'area';
    protected $primaryKey = 'area_id';
    protected $fillable = [
        'nama_area'
       ,'created_at'
       ,'updated_at'
    ];
    public function wilayah()
    {

        return $this->hasMany(wilayah::class);

    }
}

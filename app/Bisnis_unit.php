<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bisnis_unit extends Model
{
    protected $table = 'bisnis_unit';
    protected $primaryKey = 'bu_id';
    protected $fillable = [
        'nama_bisnis_unit'
       ,'created_at'
       ,'updated_at'
    ];
    public $timestamps = false;
    public function customer()
    {

        return $this->hasMany(\App\Customer::class);

    }
}

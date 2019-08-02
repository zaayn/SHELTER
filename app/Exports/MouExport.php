<?php

namespace App\Exports;

use App\datamou;
use Maatwebsite\Excel\Concerns\FromCollection;

class MouExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return datamou::all();
    }
}

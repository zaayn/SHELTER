<?php

namespace App\Exports;

use App\Keluhan;
use Maatwebsite\Excel\Concerns\FromCollection;

class KeluhanExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Keluhan::all();
    }
}

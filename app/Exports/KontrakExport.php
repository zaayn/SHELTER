<?php

namespace App\Exports;

use App\Kontrak;
use Maatwebsite\Excel\Concerns\FromCollection;

class KontrakExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Kontrak::all();
    }
}

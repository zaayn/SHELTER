<?php

namespace App\Exports;

use App\Kontrak;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class KontrakExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Kontrak::all();
    }
    public function headings(): array
    {
        return [
            'No',
            'Kode Customer',
            'Periode Kontrak',
            'Akhir Periode',
            'Surat Pemberitahuan',
            'Tgl_Surat Pemberitahuan',
            'Surat Penawaran',
            'Tgl_Surat Penawaran',
            'Dealing',
            'Tanggal Dealing',
            'Posisi Pks',
            'Closing',
            'Created_at',
            'Update_at'
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                //$spreadsheet = $event->spreadsheet;
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);

            },
        ];
    }
}

<?php

namespace App\Exports;

use App\Visit;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class VisitExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Visit::all();
    }
    public function headings(): array
    {
        return [
            'ID Visit',
            'Nama Perusahaan',
            'SPV_PIC',
            'Tanggal Visit',
            'Waktu In',
            'Waktu Out',
            'PIC Meeted',
            'Kegiatan',
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

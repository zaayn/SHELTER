<?php

namespace App\Exports;

use App\datamou;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class MouExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return datamou::all();
    }
    public function headings(): array
    {
        return [
            'No. MoU',
            'ID Kontrak',
            'HC',
            'Invoice',
            'MF',
            'MF (%)',
            'BPJS Ketenagakerjaan',
            'BPJS Kesehatan',
            'Jiwasraya',
            'Ramamusa',
            'Ditagihkan',
            'Diprovisasikan',
            'Overheadcost',
            'Training',
            'Tanggal Invoice',
            'Time of Payment',
            'Cut of Date',
            'Kaporlap',
            'Devices',
            'Chemical',
            'Pendaftaran MoU',
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

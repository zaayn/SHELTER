<?php

namespace App\Exports;

use App\Keluhan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class KeluhanExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Keluhan::all();
    }
    public function headings(): array
    {
        return [
            'No',
            'Nama Perusahaan',
            'Departemen Tertuju',
            'Tanggal Keluhan',
            'Topik Permasalahan',
            'Saran Penyelesaian',
            'Time Target',
            'Confirm Closed PIC',
            'Case',
            'Actual Case',
            'Uraian Penyelesaian',
            'Status',
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

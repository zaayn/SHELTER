<?php

namespace App\Exports;

use App\Kontrak;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Support\Facades\Auth;
use DB;

class KeluhanOfficerExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $keluhan = Keluhan::whereHas('customer', function($query){
            $query->where('nama_depan', Auth::user()->nama_depan);
          })->get();
        return $keluhan;
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
            'Status'
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

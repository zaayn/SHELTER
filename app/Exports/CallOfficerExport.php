<?php

namespace App\Exports;

use App\Call;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Support\Facades\Auth;
use DB;

class CallOfficerExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $call = Call::whereHas('customer', function($query){
            $query->where('nama_depan', Auth::user()->nama_depan);
        })->get();
        return $call;
    }
    public function headings(): array
    {
        return [
            'No',
            'Nama Perusahaan',
            'Tanggal Call',
            'Jam Call',
            'Pembicaraan',
            'PIC Call',
            'Hal Menonjol',
            'Date Created',
            'Date Updated'
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

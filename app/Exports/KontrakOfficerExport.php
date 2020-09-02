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

class KontrakOfficerExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $kontrak = Kontrak::whereHas('customer', function($query){
            $query->where('nama_depan', Auth::user()->nama_depan);
        })->get();
        return $kontrak;
    }
    public function headings(): array{
        return [
            'No',
            'Nama Customer',
            'Periode Kontrak',
            'Akhir Periode',
            'Surat Pemberitahuan',
            'Tgl_Surat Pemberitahuan',
            'Surat Penawaran',
            'Tgl_Surat Penawaran',
            'Dealing',
            'Tanggal Dealing',
            'Posisi Pks',
            'Closing'
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

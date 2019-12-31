<?php

namespace App\Exports;

use App\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class CustomerExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //$customer = DB::table('')
        return Customer::all();
    }
    public function headings(): array
    {
        return [
            'Kode Customer',
            'Nama Perusahaan',
            'Jenis Usaha',
            'Bisnis Unit',
            'Alamat',
            'Provinsi',
            'Kabupaten',
            'Telepon',
            'Fax',
            'CP',
            'Nama Area',
            'Area',
            'Area Supervisor',
            'Status',
            'Created_at',
            'Update_at',
            'Lama Kontrak (Bulan)',
            'Tipe Customer'
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

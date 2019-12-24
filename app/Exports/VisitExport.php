<?php

namespace App\Exports;

use App\Visit;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use DB;

class VisitExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $visit = DB::table('visit')
                ->join('customer','visit.kode_customer','=','customer.kode_customer')
                ->select('visit.visit_id','customer.nama_perusahaan','visit.spv_pic',
                'visit.tanggal_visit','visit.waktu_in','visit.waktu_out','visit.pic_meeted','visit.kegiatan')
                ->get();
        return $visit;
    }
    public function headings(): array
    {
        return [
            'No',
            'Nama Perusahaan',
            'SPV_PIC',
            'Tanggal Visit',
            'Waktu In',
            'Waktu Out',
            'PIC Meeted',
            'Kegiatan'
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

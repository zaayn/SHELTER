<?php

namespace App\Exports;

use App\Call;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use DB;

class CallExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $call = DB::table('call')
                ->join('customer','call.kode_customer','=','customer.kode_customer')
                ->select('call.call_id','customer.nama_perusahaan','call.spv_pic',
                'call.jam_call','call.pembicaraan','call.pic_call','call.hal_menonjol')
                ->get();
        return $call;
    }
    public function headings(): array
    {
        return [
            'No',
            'Nama Perusahaan',
            'SPV_PIC',
            'Tanggal Call',
            'Jam Call',
            'Pembicaraan',
            'PIC Call',
            'Hal Menonjol',
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

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
        $user = Auth::user()->nama_depan;
        $call = DB::table('call')
                ->join('customer','call.kode_customer','=','customer.kode_customer')
                ->join('users','users.nama_depan','=','customer.nama_depan')
                ->select('call.call_id','customer.nama_depan','customer.nama_perusahaan',
                'call.tanggal_call','call.jam_call','call.pembicaraan','call.pic_called','call.hal_menonjol')
                ->where('users.nama_depan','=', $user)
                ->get();
        // $call = Call::whereHas('customer', function($query){
        //     $query->where('nama_depan', Auth::user()->nama_depan);
        // })->get();
        return $call;
    }
    public function headings(): array
    {
        return [
            'No',
            'Penginput',
            'Nama Perusahaan',
            'Tanggal Call',
            'Jam Call',
            'Pembicaraan',
            'PIC Call',
            'Hal Menonjol'
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

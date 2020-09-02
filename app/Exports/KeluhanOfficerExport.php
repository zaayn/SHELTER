<?php

namespace App\Exports;

use App\Keluhan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Support\Facades\Auth;

class KeluhanOfficerExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $no = 0;
        $user = Auth::user()->nama_depan;
        $keluhan = DB::table('keluhan')
            ->join('customer','keluhan.kode_customer','=','customer.kode_customer')
            ->join('users','users.nama_depan','=','customer.nama_depan')
            ->select($no++,'customer.nama_perusahaan','keluhan.departemen',
            'keluhan.tanggal_keluhan','keluhan.topik_masalah','keluhan.saran_penyelesaian',
            'keluhan.time_target','keluhan.confirm_pic','keluhan.case','keluhan.actual_case',
            'keluhan.uraian_penyelesaian','keluhan.status')
            ->where('users.nama_depan','=', $user)
            ->get();
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

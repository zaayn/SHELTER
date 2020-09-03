<?php

namespace App\Exports;

use App\datamou;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Support\Facades\Auth;
use DB;

class MouOfficerExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $user = Auth::user()->nama_depan;
        $datamou = DB::table('datamou')
                ->join('kontrak','kontrak.id_kontrak','=','datamou.id_kontrak')
                ->join('customer','kontrak.kode_customer','=','customer.kode_customer')
                ->join('users','users.nama_depan','=','customer.nama_depan')
                ->select('datamou.no_mou','kontrak.nomor_kontrak','customer.nama_perusahaan','datamou.hc',
                'datamou.invoice','datamou.mf','datamou.mf_persen','bpjs_tk_persen','bpjs_tenagakerja',
                'datamou.bpjs_kes_persen','datamou.bpjs_kesehatan','datamou.jiwasraya','datamou.ramamusa',
                'datamou.ditagihkan','datamou.diprovisasikan','datamou.overheadcost','datamou.training',
                'datamou.tanggal_invoice','datamou.time_of_payment','datamou.cut_of_date','datamou.kaporlap',
                'datamou.devices','datamou.chemical','datamou.pendaftaran_mou')
                ->where('customer.nama_depan','=', $user)
                ->get();
        return $datamou;
    }
    public function headings(): array
    {
        return [
            'No. MoU',
            'Nomor Kontrak',
            'Nama Perusahaan',
            'HC',
            'Invoice',
            'MF',
            'MF (%)',
            'Ket (%) BPJS Ketenagakerjaan',
            'BPJS Ketenagakerjaan',
            'Ket (%) BPJS Kesehatan',
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
            'Pendaftaran MoU'
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

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

class KontrakOfficerExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $user = Auth::user()->nama_depan;
        $kontrak = DB::table('kontrak')
                ->join('customer','kontrak.kode_customer','=','customer.kode_customer')
                ->join('users','users.nama_depan','=','customer.nama_depan')
                ->select('kontrak.id_kontrak','kontrak.nomor_kontrak','customer.nama_perusahaan','kontrak.periode_kontrak',
                'kontrak.akhir_periode','kontrak.srt_pemberitahuan','kontrak.tgl_srt_pemberitahuan',
                'kontrak.srt_penawaran','kontrak.tgl_srt_penawaran','kontrak.dealing','kontrak.tgl_dealing',
                'kontrak.posisi_pks','kontrak.closing')
                ->where('users.nama_depan','=', $user)
                ->get();
        return $kontrak;
    }
    public function headings(): array{
        return [
            'No',
            'Nomor Kontrak',
            'Kode Customer',
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

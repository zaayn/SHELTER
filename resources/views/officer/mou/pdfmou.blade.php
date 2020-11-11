<!DOCTYPE html>
<html>
<head>
	<title>Laporan MoU</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 7pt;
		}
        div.page
        {
            page-break-after: always;
            page-break-inside: avoid;
        }
	</style>
	<center>
		<h5>Laporan MoU</h4>
	</center>
 
    <div class="page">
	<table class='table table-bordered'>
		<thead>
			<tr>
                <th>No. MoU</th>
                <th>Nomor Kontrak</th>
                <th>No. Adendum</th>
                <th>HC</th>
                <th>Invoice</th>
                <th>MF</th>
                <th>MF (%)</th>
                <th>Ket. % BPJS Ketenagakerjaan</th>
                <th>Nominal BPJS Ketenagakerjaan</th>
                <th>Ket. % BPJS Kesehatan</th>
                <th>Nominal BPJS Kesehatan</th>
                <th>Jiwasraya</th>
                <th>Ramamusa</th>
                <th>Ditagihkan</th>
                
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			@foreach($datamou as $datamou)
			<tr>
			    <td>{{ $i++ }}</td>
                <td>{{ $datamou->kontrak->nomor_kontrak }}</td>
                <td>{{ $datamou->no_adendum }}</td>
                <td>{{ $datamou->hc }}</td>
                <td>Rp {{ $datamou->invoice }}</td>
                <td>Rp {{ $datamou->mf }}</td>
                <td>{{ $datamou->mf_persen ?$datamou->mf_persen.'%':'' }} </td>
                <td>{{ $datamou->bpjs_tk_persen ?$datamou->bpjs_tk_persen.'%':''}}</td>
                <td>{{ $datamou->bpjs_tenagakerja ?'Rp'.$datamou->bpjs_tenagakerja:'' }}</td>
                <td>{{ $datamou->bpjs_kes_persen ?$datamou->bpjs_kes_persen.'%':'' }}</td>
                <td>{{ $datamou->bpjs_kesehatan ?'Rp'.$datamou->bpjs_kesehatan:'' }}</td>
                <td>{{ $datamou->jiwasraya ?'Rp'.$datamou->jiwasraya:'' }}</td>
                <td>{{ $datamou->ramamusa ?'Rp'.$datamou->ramamusa:'' }}</td>
                <td>{{ $datamou->ditagihkan }}</td>
                
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
<div class="page">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Diprovisasikan</th>
                <th>Overheadcost</th>
                <th>Training</th>
                <th>Tanggal Invoice</th>
                <th>Time of Payment</th>
                <th>Cut of Date</th>
                <th>Kaporlap</th>
                <th>Devices</th>
                <th>Chemical</th>
                <th>Pendaftaran MoU</th>
            </tr>
        </thead>
        <tbody>
        @foreach($datamou as $datamou)
            <tr>
                <td>{{ $datamou->diprovisasikan }}</td>
                <td>{{ $datamou->overheadcost }}</td>
                <td>{{ $datamou->training }}</td>
                <td>{{ $datamou->tanggal_invoice }}</td>
                <td>{{ $datamou->time_of_payment }}</td>
                <td>{{ $datamou->cut_of_date }}</td>
                <td>{{ $datamou->kaporlap }}</td>
                <td>{{ $datamou->devices }}</td>
                <td>{{ $datamou->chemical }}</td>
                <td>{{ $datamou->pendaftaran_mou }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
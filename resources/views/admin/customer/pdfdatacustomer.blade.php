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
			font-size: 4pt;
		}
	</style>
	<center>
		<h5>Laporan MoU</h4>
	</center>
 
	<table class='table table-bordered'>
		<thead>
			<tr>
                <th>No</th>
                <th>Nama Perusahaan</th>
                                    <th>Bisnis Unit</th>
                                    <th>Area</th>
                                    <th>Alamat Perusahaan</th>
                                    {{--    
                                        <th>PIC</th>
                                        <th>CP</th>
                                        <th>Email</th> 
                                    --}}
                                    <th>Jenis Usaha</th>
                                    <th>Periode Kontrak</th>
                                    <th>Akhir Periode Kontrak</th>
                                    <th>Customer Type</th>
                                    <th>Nomor Kontrak</th> 
                                    <th>HC</th>
                                    <th>Invoice</th>
                                    <th>MF</th>
                                    <th>MF (%)</th>
                                    <th>BPJS Ketenagakerjaan</th>
                                    <th>BPJS Kesehatan</th>
                                    <th>Jiwasraya</th>
                                    <th>Ramamusa</th>
                                    <th>Ditagihkan</th>
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
			@php $i=1 @endphp
			@foreach($datamous as $datamou)
			<tr>
			<td>{{ $i++ }}</td>
            <td>{{ $datamou->nama_perusahaan }}</td>
                                    <td>{{ $datamou->nama_bisnis_unit }}</td>
                                    <td>{{ $datamou->provinsi }}</td>
                                    <td>{{ $datamou->alamat }}</td>
                                    <td>{{ $datamou->jenis_usaha }}</td>
                                    <td>{{ $datamou->periode_kontrak }}</td>
                                    <td>{{ $datamou->akhir_periode }}</td>
                                    <td>{{ $different }}</td>
                                    <td>{{ $datamou->id_kontrak }}</td>
                                    <td>{{ $datamou->hc }}</td>
                                    <td>{{ $datamou->invoice }}</td>
                                    <td>{{ $datamou->mf }}</td>
                                    <td>{{ $datamou->mf_persen }}</td>
                                    <td>{{ $datamou->bpjs_tenagakerja }}</td>
                                    <td>{{ $datamou->bpjs_kesehatan }}</td>
                                    <td>{{ $datamou->jiwasraya }}</td>
                                    <td>{{ $datamou->ramamusa }}</td>
                                    <td>{{ $datamou->ditagihkan }}</td>
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
 
</body>
</html>
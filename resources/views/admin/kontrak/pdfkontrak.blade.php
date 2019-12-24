<!DOCTYPE html>
<html>
<head>
	<title>Laporan Kontrak</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 6pt;
		}
	</style>
	<center>
		<h5>Laporan Kontrak</h4>
	</center>
 
	<table class='table table-bordered'>
		<thead>
			<tr>
            <th>No</th>
            <th>Nomor Kontrak</th>
                                    <th>Kode Customer</th>
                                    <th>Nama Perusahaan</th>
                                    <th>Periode Kontrak</th>
                                    <th>Akhir Periode</th>
                                    <th>Surat Pemberitahuan</th>
                                    <th>Tgl_Surat Pemberitahuan</th>
                                    <th>Surat Penawaran</th>
                                    <th>Tgl_Surat Penawaran</th>
                                    <th>Dealing</th>
                                    <th>Tgl_Dealing</th>
                                    <th>Posisi Pks</th>
                                    <th>Closing</th>
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			@foreach($kontrak as $kontrak)
			<tr>
			<td>{{ $i++ }}</td>
                <td>{{ $kontrak->nomor_kontrak }}</td>
                <td>{{ $kontrak->kode_customer }}</td>
                <td>{{ $kontrak->customer->nama_perusahaan }}</td>
                <td>{{ $kontrak->periode_kontrak }}</td>
                <td>{{ $kontrak->akhir_periode }}</td>
                <td>{{ $kontrak->srt_pemberitahuan }}</td>
                <td>{{ $kontrak->tgl_srt_pemberitahuan }}</td>
                <td>{{ $kontrak->srt_penawaran }}</td>
                <td>{{ $kontrak->tgl_srt_penawaran }}</td>
                <td>{{ $kontrak->dealing }}</td>
                <td>{{ $kontrak->tgl_dealing }}</td>
                <td>{{ $kontrak->posisi_pks }}</td>
                <td>{{ $kontrak->closing }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
 
</body>
</html>
<!DOCTYPE html>
<html>
<head>
	<title>Laporan Keluhan</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
		<h5>Laporan Keluhan</h4>
	</center>
 
	<table class='table table-bordered'>
		<thead>
			<tr>
            <th>No</th>
                                    <th>Nama Customer</th>
                                    <th>Departemen Tertuju</th>
                                    <th>Tanggal</th>
                                    <th>Topik Permasalahan</th>
                                    <th>Saran Penyelesaian</th>
                                    <th>Time Target (Tgl)</th>
                                    <th>Confirm closed PIC</th>
                                    <th>Case</th>
                                    <th>Actual Closed</th>
                                    <th>Uraian Penyelesaian</th>
                                    <th>Status</th>
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			@foreach($keluhan as $keluhan)
			<tr>
            <td>{{ $i++ }}</td>
                                    <td>{{ $keluhan->customer->nama_customer }}</td>
                                    <td>{{ $keluhan->departemen }}</td>
                                    <td>{{ $keluhan->tanggal_keluhan }}</td>
                                    <td>{{ $keluhan->topik_masalah }}</td>
                                    <td>{{ $keluhan->saran_penyelesaian }}</td>
                                    <td>{{ $keluhan->time_target }}</td>
                                    <td>{{ $keluhan->confirm_pic }}</td>
                                    <td>{{ $keluhan->case }}</td>
                                    <td>{{ $keluhan->actual_case }}</td>
                                    <td>{{ $keluhan->uraian_penyelesaian }}</td>
                                    <td>{{ $keluhan->status }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
 
</body>
</html>
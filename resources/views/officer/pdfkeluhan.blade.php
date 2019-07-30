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
            <th style="width:10%">ID Keluhan</th>
                                    <th>Nama Customer</th>
                                    <th>SPV_PIC</th>
                                    <th>Tanggal</th>
                                    <th>Waktu Keluhan</th>
                                    <th>Keluhan</th>
                                    <th>PIC Keluhan</th>
                                    <th>Waktu Follow</th>
                                    <th>Follow Up</th>
                                    <th>Closing Case</th>
                                    <th>Via</th>
                                    <th>Status</th>
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			@foreach($keluhan as $keluhan)
			<tr>
            <td>{{ $i++ }}</td>
			<td>{{ $keluhan->id_keluhan  }}</td>
                                    <td>{{ $keluhan->nama_customer }}</td>
                                    <td>{{ $keluhan->spv_pic }}</td>
                                    <td>{{ $keluhan->tanggal_keluhan }}</td>
                                    <td>{{ $keluhan->jam_keluhan }}</td>
                                    <td>{{ $keluhan->keluhan }}</td>
                                    <td>{{ $keluhan->pic }}</td>
                                    <td>{{ $keluhan->jam_follow }}</td>
                                    <td>{{ $keluhan->follow_up }}</td>
                                    <td>{{ $keluhan->closing_case }}</td>
                                    <td>{{ $keluhan->via }}</td>
                                    <td>{{ $keluhan->status }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
 
</body>
</html>
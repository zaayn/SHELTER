<!DOCTYPE html>
<html>
<head>
	<title>Laporan Call</title>
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
		<h5>Laporan Call</h4>
	</center>
 
	<table class='table table-bordered'>
		<thead>
			<tr>
			<th>No</th>
            <th>Nama Customer</th>
            <th>SPV_PIC</th>
            <th>Tanggal</th>
            <th>Waktu Call</th>
            <th>Pembicaraan</th>
            <th>PIC Call</th>
            <th>Hal Menonjol</th>
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			@foreach($call as $call)
			<tr>
			<td>{{ $i++ }}</td>
            <td>{{ $call->customer->nama_perusahaan }}</td>
            <td>{{ $call->spv_pic }}</td>
            <td>{{ $call->tanggal_call }}</td>
            <td>{{ $call->jam_call }}</td>
            <td>{{ $call->pembicaraan }}</td>
            <td>{{ $call->pic_called }}</td>
            <td>{{ $call->hal_menonjol }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
 
</body>
</html>
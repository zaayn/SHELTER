<!DOCTYPE html>
<html>
<head>
	<title>Laporan Visit</title>
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
		<h5>Laporan Visit</h4>
	</center>
 
	<table class='table table-bordered'>
		<thead>
			<tr>
                <th>No</th>
                <th>Nama Customer</th>
                <th>SPV_PIC</th>
                <th>Tanggal</th>
                <th>Waktu In</th>
                <th>Waktu Out</th>
                <th>PIC Visit</th>
                <th>Kegiatan</th>
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			@foreach($visit as $visit)
			<tr>
			    <td>{{ $i++ }}</td>
                <td>{{ $visit->nama_customer }}</td>
                <td>{{ $visit->spv_pic }}</td>
                <td>{{ $visit->tanggal_visit }}</td>
                <td>{{ $visit->waktu_in }}</td>
                <td>{{ $visit->waktu_out }}</td>
                <td>{{ $visit->pic_meeted }}</td>
                <td>{{ $visit->kegiatan }}</td>			
            </tr>
			@endforeach
		</tbody>
	</table>
 
</body>
</html>
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
            <th>Kode Customer</th>
            <th>Nama Perusahaan</th>
            <th>Jenis Usaha</th>
            <th>Bisnis Unit</th>
            <th>Alamat</th>
            <th>Provinsi</th>
            <th>Kabupaten</th>
            <th>telpon</th>
            <th>cp</th>
            <th>Area</th>
            <th>Wilayah</th>
            <th>Area Supervisor</th>
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			@foreach($customer as $customer)
			<tr>
			<td>{{ $i++ }}</td>
                                        <td>{{ $customer->kode_customer }}</td>
                                        <td>{{ $customer->nama_perusahaan }}</td>
                                        <td>{{ $customer->jenis_usaha }}</td>
                                        <td>{{ $customer->bisnis_unit->nama_bisnis_unit }}</td>
                                        <td>{{ $customer->alamat }}</td>
                                        <td>{{ $customer->provinsi }}</td>
                                        <td>{{ $customer->kabupaten }}</td>
                                        <td>{{ $customer->telpon }}</td>
                                        <td>{{ $customer->cp }}</td>
                                        {{-- <td>{{ $customer->nama_area}}</td> --}}
                                        {{-- <td>{{ $customer->wilayah->nama_wilayah}}</td> --}}
                                        <td>{{ $customer->nama_area}}</td>
                                        <td>{{ $customer->wilayah->nama_wilayah}}</td>
                                        <td>{{ $customer->nama_depan}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
 
</body>
</html>
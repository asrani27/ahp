<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>
<body>
    <table border=0>
        <tr>
            <td width="20%" style="text-align: right">
                <img src="/logo/rri.png" width="70%">
            </td>
            <td>
                RRI BANJARMASIN<br/>
                Jl. A Yani KM 3,5 No 7, Karang Mekar, Kec. Banjarmasin Timur,<br/>
                Kota Banjarmasin, Kalimantan Selatan 70234
            </td>
        </tr>
        <tr>
            <td colspan=2 style="text-align:center"><br/><strong><u>LAPORAN DATA ARSIP</u></strong></td>
        </tr>
    </table>
    <br/>
    <table border=1 cellspacing="0" cellpadding="3" width="100%">
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>ID File</th>
            <th>Nama File</th>
            <th>Illustrasi</th>
            <th>Penyedia</th>
            <th>Status</th>
        </tr>
        @php
            $no =1;
        @endphp
        @foreach ($data as $key => $item)
            <tr>
                <td style="text-align: center">{{$no++}}</td>
                <td style="text-align: center">{{\Carbon\Carbon::parse($item->tanggal)->format('d-m-Y')}}</td>
                <td style="text-align: center">ARSIP-{{$item->no_file}}</td>
                <td style="text-align: center">{{$item->nama}}</td>
                <td style="text-align: center">{{$item->illustrasi}}</td>
                <td style="text-align: center">{{$item->penyedia->nama}}</td>
                <td style="text-align: center">{{$item->status}}</td>
            </tr>
        @endforeach
    </table>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>

$(document).ready(function(){
    window.print();
});
</script>
</html>
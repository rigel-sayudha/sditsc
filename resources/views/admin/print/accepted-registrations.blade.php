<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rekap Siswa Lolos Seleksi</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 30px; }
        .title { color: #0f8941; font-size: 2em; font-weight: bold; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #0f8941; padding: 8px 6px; font-size: 0.98em; }
        th { background: #e6f9ee; color: #0f8941; }
        tr:nth-child(even) { background: #f8fff8; }
        tr:nth-child(odd) { background: #fff; }
        .footer { text-align: center; margin-top: 40px; color: #888; font-size: 0.9em; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">Rekap Siswa Lolos Seleksi</div>
        <div style="color:#555; font-size:1.1em;">Tahun Ajaran {{ date('Y') }}/{{ date('Y')+1 }}</div>
    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <!-- <th>Email</th> -->
                <th>Jadwal Tes ABK</th>
                <th>Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Pekerjaan Ayah</th>
                <th>Pekerjaan Ibu</th>
                <th>Penghasilan Ayah</th>
                <th>Penghasilan Ibu</th>
                <th>Alamat</th>
                <th>No. Telp</th>
            </tr>
        </thead>
        <tbody>
            @foreach($registrations as $i => $reg)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $reg->nama }}</td>
                <!-- <td>{{ $reg->email }}</td> -->
                <td>{{ $reg->jadwal_abk }}</td>
                <td>{{ $reg->tanggal_lahir }}</td>
                <td>{{ $reg->jenis_kelamin }}</td>
                <td>{{ $reg->pekerjaan_ayah }}</td>
                <td>{{ $reg->pekerjaan_ibu }}</td>
                <td>{{ $reg->penghasilan_ayah }}</td>
                <td>{{ $reg->penghasilan_ibu }}</td>
                <td>{{ $reg->alamat }}</td>
                <td>{{ $reg->telepon_ortu }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="footer">
        Dicetak otomatis dari sistem pendaftaran sekolah &mdash; {{ date('d M Y H:i') }}
    </div>
</body>
</html>

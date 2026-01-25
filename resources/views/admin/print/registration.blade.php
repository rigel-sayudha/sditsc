<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Pendaftaran Siswa</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 30px; }
        .title { color: #0f8941; font-size: 2em; font-weight: bold; }
        .box { border: 2px solid #0f8941; border-radius: 10px; padding: 24px; margin: 0 auto; max-width: 600px; background: #f8fff8; }
        .row { margin-bottom: 12px; }
        .label { font-weight: bold; color: #0f8941; width: 180px; display: inline-block; }
        .value { color: #222; }
        .footer { text-align: center; margin-top: 40px; color: #888; font-size: 0.9em; }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">Data Pendaftaran Siswa Baru</div>
        <div style="color:#555; font-size:1.1em;">Tahun Ajaran {{ date('Y') }}/{{ date('Y')+1 }}</div>
    </div>
    <div class="box">
        <div class="row"><span class="label">Nama Lengkap:</span> <span class="value">{{ $registration->nama }}</span></div>
        <div class="row"><span class="label">Jadwal Tes ABK:</span> <span class="value">{{ $registration->jadwal_abk }}</span></div>
        <div class="row"><span class="label">Tanggal Lahir:</span> <span class="value">{{ $registration->tanggal_lahir }}</span></div>
        <div class="row"><span class="label">Jenis Kelamin:</span> <span class="value">{{ $registration->jenis_kelamin }}</span></div>
        <div class="row"><span class="label">Pekerjaan Ayah:</span> <span class="value">{{ $registration->pekerjaan_ayah }}</span></div>
        <div class="row"><span class="label">Penghasilan Ayah:</span> <span class="value">{{ $registration->penghasilan_ayah }}</span></div>
        <div class="row"><span class="label">Pekerjaan Ibu:</span> <span class="value">{{ $registration->pekerjaan_ibu }}</span></div>
        <div class="row"><span class="label">Penghasilan Ibu:</span> <span class="value">{{ $registration->penghasilan_ibu }}</span></div>
        <div class="row"><span class="label">Alamat:</span> <span class="value">{{ $registration->alamat }}</span></div>
        <div class="row"><span class="label">No. Orang Tua:</span> <span class="value">{{ $registration->telepon_ortu }}</span></div>
    </div>
    <div class="footer">
        Dicetak otomatis dari sistem pendaftaran sekolah &mdash; {{ date('d M Y H:i') }}
    </div>
</body>
</html>

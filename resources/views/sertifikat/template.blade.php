<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sertifikat</title>
    <style>
        body {
            font-family: 'Times New Roman', serif;
            text-align: center;
            padding: 50px;
            border: 10px solid #0a3d62;
        }
        .inner {
            border: 5px solid #3c6382;
            padding: 30px;
        }
        h1 {
            font-size: 40px;
            margin-bottom: 10px;
            color: #0a3d62;
        }
        h2 {
            margin-top: 0;
            font-size: 28px;
            font-weight: normal;
        }
        .name {
            font-size: 32px;
            margin: 30px 0 10px 0;
            font-weight: bold;
            text-transform: uppercase;
        }
        .details {
            font-size: 18px;
            margin-bottom: 40px;
        }
        .footer {
            margin-top: 60px;
            display: flex;
            justify-content: space-between;
            padding: 0 50px;
        }
        .footer div {
            text-align: center;
        }
        .footer p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
<div class="inner">
    <h1>SERTIFIKAT</h1>
    <h2>Diberikan Kepada:</h2>

    <div class="name">{{ $siswa->nama }}</div>

    <div class="details">
        Telah menyelesaikan <b>Praktek Kerja Lapangan (PKL)</b> <br>
        pada perusahaan <b>{{ $siswa->tempats->first()->nama_perusahaan ?? '-' }}</b> <br>
        Jurusan <b>
            @if($siswa->jurusan == 'RPL')
                Rekayasa Perangkat Lunak
            @elseif($siswa->jurusan == 'DKV')
                Desain Komunikasi Visual
            @else
                {{ $siswa->jurusan }}
            @endif
        </b>
    </div>

    <div class="footer">
        <div>
            <p><b>PIHAK PERTAMA</b></p>
            <p>Kepala SMK-IT As-Syifa</p>
            <br><br><br>
            <p><b><u>H. Agus Nur Purwanto, S.T.</u></b></p>
            <p>NIP. ..................</p>
        </div>
        <div>
            <p><b>PIHAK KEDUA</b></p>
            <p>Pimpinan DUDI</p>
            <br><br><br>
            <p><b><u>{{ $siswa->tempats->first()->pimpinan ?? '..................' }}</u></b></p>
            <p>{{ $siswa->tempats->first()->telepon_perusahaan ?? '..................' }}</p>
        </div>
    </div>
</div>
</body>
</html>

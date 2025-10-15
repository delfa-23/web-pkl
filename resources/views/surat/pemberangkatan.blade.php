<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Surat Pengantar Keberangkatan PKL</title>
    <style>
        @page {
            margin: 0cm;
        }

        body {
            font-family: "Times New Roman", serif;
            font-size: 10.5pt;
            line-height: 1.25;
            margin: 0;
            padding: 0;
        }

        .kop img,
        .footer img {
            width: 100%;
            height: auto;
            display: block;
        }

        .content {
            margin: 5px 60px 20px 60px;
            text-align: justify;
            line-height: 1.25;
        }

        h2 {
            text-align: center;
            text-decoration: underline;
            margin-bottom: 5px;
            margin-top: 0;
        }

        .nomor {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
        }

        table td {
            padding: 2px 6px;
            vertical-align: top;
        }

        .footer {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
        }

        .ttd {
            text-align: center;
            margin-top: 25px;
        }
    </style>
</head>

<body>
    @php
        $kop = base64_encode(file_get_contents(public_path('assets/img/kop.png')));
        $footer = base64_encode(file_get_contents(public_path('assets/img/footer.png')));
    @endphp

    <!-- Kop -->
    <div class="kop">
        <img src="data:image/png;base64,{{ $kop }}" alt="Kop Surat">
    </div>

    <!-- Isi Surat -->
    <div class="content">
        <h2>SURAT PENGANTAR KEBERANGKATAN</h2>
        <p class="nomor">Nomor: ....../SMK-IT/AS-SYIFA/............/20....</p>

        <p>Yang bertanda tangan di bawah ini:</p>
        <table>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td>..............................................................................</td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td>:</td>
                <td>............................................................................</td>
            </tr>
            <tr>
                <td>Sekolah</td>
                <td>:</td>
                <td>SMK-IT As-Syifa Boarding School</td>
            </tr>
        </table>

        <p>Dengan ini menerangkan bahwa:</p>
        <table>
            <tr>
                <td>Nama Siswa</td>
                <td>:</td>
                <td>{{ $siswa->nama }}</td>
            </tr>
            <tr>
                <td>NIS</td>
                <td>:</td>
                <td>{{ $siswa->nis ?? '................................' }}</td>
            </tr>
            <tr>
                <td>Kelas</td>
                <td>:</td>
                <td>{{ $siswa->kelas }}</td>
            </tr>
            <tr>
                <td>Jurusan</td>
                <td>:</td>
                <td>{{ $siswa->jurusan }}</td>
            </tr>
        </table>

        <p>
            adalah benar siswa SMK-IT As-Syifa Boarding School yang akan melaksanakan Praktik Kerja Lapangan (PKL) di:
        </p>

        <table>
            <tr>
                <td>Tempat PKL</td>
                <td>:</td>
                <td>{{ $siswa->tempats->first()->nama_perusahaan ?? '................................' }}</td>
            </tr>
            <tr>
                <td>Alamat Perusahaan</td>
                <td>:</td>
                <td>{{ $siswa->tempats->first()->alamat_perusahaan ?? '................................' }}</td>
            </tr>
            <tr>
                <td>Waktu PKL</td>
                <td>:</td>
                <td>.................................. s/d ..................................</td>
            </tr>
        </table>

        <p>
            Sehubungan dengan itu, kami mohon kepada pihak perusahaan/instansi agar dapat menerima siswa tersebut untuk
            melaksanakan PKL sesuai ketentuan yang berlaku.
        </p>
        <p>
            Demikian surat pengantar ini dibuat untuk dipergunakan sebagaimana mestinya. Atas perhatian dan kerja
            samanya,
            kami ucapkan terima kasih.
        </p>
        <p>Wassalamu’alaikum Wr. Wb.</p>

        <div class="ttd">
            <p>Mengetahui,</p>
            <p>Kepala SMK-IT As-Syifa Boarding School</p>
            <br><br><br>
            <p><b>H. AGUS NUR PURWANTO, S.T.</b></p>
            <p>NIY. ...................................</p>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <img src="data:image/png;base64,{{ $footer }}" alt="Footer Surat">
    </div>
</body>

</html>

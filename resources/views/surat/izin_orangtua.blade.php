<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Izin Orang Tua/Wali</title>
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
            margin: 10px 60px 20px 60px;
            /* naikkan konten ke atas */
            text-align: justify;
            line-height: 1.25;
            /* biar teks agak rapet */
        }

        .center {
            text-align: center;
            font-weight: bold;
            margin-top: 0;
            margin-bottom: 15px;
        }

        .right {
            text-align: right;
        }

        .indent {
            text-indent: 40px;
        }

        .ttd {
            text-align: right; /* Mengubah ke kanan untuk tanda tangan Ortu/Wali */
            margin-top: 25px;
        }

        .footer {
            position: fixed; /* Menggunakan fixed agar tetap di bawah meskipun konten panjang */
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
        }

        /* Penyesuaian untuk data formulir */
        .data-ortu, .data-siswa, .data-pkl {
            margin-top: 10px;
            margin-bottom: 10px;
        }
        .data-ortu p, .data-siswa p, .data-pkl p {
            margin: 0;
            padding: 0;
            margin-left: 50px;
        }
    </style>
</head>

<body>
    @php
        // Pastikan variabel $kop dan $footer tersedia atau isi dengan placeholder jika belum ada
        // Asumsi file_get_contents dan base64_encode bekerja di lingkungan yang sebenarnya
        $kop = base64_encode(file_exists(public_path('assets/img/kop.png')) ? file_get_contents(public_path('assets/img/kop.png')) : '');
        $footer = base64_encode(file_exists(public_path('assets/img/footer.png')) ? file_get_contents(public_path('assets/img/footer.png')) : '');

        // Placeholder untuk menghindari error jika data siswa belum terdefinisi (untuk contoh ini)
        $siswa = $siswa ?? (object)[
            'nama' => null,
            'nis' => null,
            'kelas' => null,
            'jurusan' => null,
            'tempatAktif' => function() {
                return (object)['nama_perusahaan' => null, 'alamat_perusahaan' => null];
            }
        ];
    @endphp

    <div class="kop">
        <img src="data:image/png;base64,{{ $kop }}" alt="Kop Surat">
    </div>

    <div class="content">
        <h3 class="center" style="margin-top: 0;"><u>SURAT IZIN ORANG TUA/WALI</u></h3>

        <p>Yang bertanda tangan di bawah ini:</p>
        <div class="data-ortu">
            <p>Nama Orang Tua/Wali : .........................................................</p>
            <p>Alamat : ..............................................................................................</p>
            <p>No. HP : ..............................................................................................</p>
        </div>

        <p style="margin-top: 15px;">adalah orang tua/wali dari:</p>
        <div class="data-siswa">
            <p>Nama Siswa : {{ $siswa->nama ?? '..................................' }}</p>
            <p>NIS : {{ $siswa->nis ?? '..................................' }}</p>
            <p>Kelas : {{ $siswa->kelas ?? '..................................' }}</p>
            <p>Jurusan : {{ $siswa->jurusan ?? '..................................' }}</p>
        </div>

        <p style="text-align: justify; margin-top: 15px;">
            Dengan ini memberikan izin kepada putra/putri kami untuk mengikuti
            <b>Praktik Kerja Lapangan (PKL)</b> yang diselenggarakan oleh
            SMK-IT As-Syifa Boarding School pada:
        </p>

        <div class="data-pkl">
            @if($siswa->tempatAktif() ?? false)
            <p>Tempat PKL : {{ $siswa->tempatAktif()->nama_perusahaan ?? '..................................' }}</p>
            <p>Alamat Perusahaan : {{ $siswa->tempatAktif()->alamat_perusahaan ?? '..................................' }}</p>
            @else
            <p>Tempat PKL : ..................................................</p>
            <p>Alamat Perusahaan : ..................................................</p>
            @endif
            <p>Waktu Pelaksanaan : .......................... s/d ..........................</p>
        </div>

        <p style="text-align: justify; margin-top: 15px;">
            Saya selaku orang tua/wali memahami bahwa kegiatan PKL ini merupakan bagian dari program pendidikan sekolah,
            serta menyetujui putra/putri kami untuk mengikuti kegiatan tersebut dengan penuh tanggung jawab.
        </p>

        <p style="text-align: justify;">
            Demikian surat izin ini dibuat dengan sebenarnya, untuk digunakan sebagaimana mestinya.
        </p>

        <div class="ttd">
            <p>.................................., ................. 2025</p>
            <p>Hormat kami,</p>
            <p>Orang Tua/Wali,</p>
            <br><br><br>
            <p>(.............................................)</p>
        </div>
    </div>

    <div class="footer">
        <img src="data:image/png;base64,{{ $footer }}" alt="Footer Surat">
    </div>
</body>
</html>

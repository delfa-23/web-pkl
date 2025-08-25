<!DOCTYPE html>
<html>
<head>
    <title>Surat Persetujuan Orang Tua</title>
    <style>
        body { font-family: Times New Roman, serif; line-height: 1.5; }
        .center { text-align: center; }
        .right { text-align: right; }
        .indent { margin-left: 40px; }
    </style>
</head>
<body>

    <h3 class="center"><u>SURAT PERSETUJUAN ORANG TUA</u></h3>
    <br>

    <p>Saya yang bertanda tangan di bawah ini:</p>
    <p>Nama Orang Tua/Wali : .........................................................</p>
    <p>Tempat/Tanggal Lahir : .........................................................</p>
    <p>Pekerjaan : .........................................................</p>
    <p>Alamat : ..............................................................................................</p>

    <p>Adalah orang tua/wali dari:</p>
    <p>Nama Siswa : {{ $siswa->nama }}</p>
    <p>Tempat/Tanggal Lahir : {{ $siswa->tempat_lahir ?? '................' }}, {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->format('d-m-Y') ?? '................' }}</p>
    <p>Sekolah : SMKIT As-Syifa Boarding School Subang</p>
    <p>Jurusan : {{ $siswa->jurusan ?? '..........................' }}</p>
    <p>Alamat : {{ $siswa->alamat ?? '..........................' }}</p>

    <p>
        Dengan ini menyatakan bahwa <b>saya menyetujui anak saya untuk mengikuti Program Magang
        Merdeka Belajar Kampus Merdeka (MBKM)</b> yang diselenggarakan oleh pihak terkait,
        serta bersedia ditempatkan pada mitra penerima magang sesuai dengan kriteria dan persyaratan yang berlaku.
    </p>

    <p>
        Demikian surat persetujuan ini saya buat dengan sebenar-benarnya, dalam keadaan sadar,
        tanpa adanya paksaan dari pihak manapun. Apabila di kemudian hari saya mengingkari pernyataan ini,
        saya bersedia menerima sanksi sesuai dengan ketentuan yang berlaku.
    </p>


    <div class="right">
        <p>Kota ...................., .................... 20.....</p>
        <p>Pembuat Pernyataan,</p>
        <br><br><br>
        <p>TTD & Materai Rp10.000</p>
        <br>
        <p>(.............................................)</p>
    </div>

</body>
</html>

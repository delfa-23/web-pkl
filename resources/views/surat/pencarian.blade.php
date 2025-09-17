<!DOCTYPE html>
<html>
<head>
    <title>Surat Pencarian</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 8px; text-align: left; }
        h2, h3 { margin: 0; padding: 5px 0; }
        .content { margin: 40px; }
    </style>
</head>
<body>
    <div class="content">
        <h2>Surat Pencarian</h2>

        <p><b>Nama:</b> {{ $siswa->nama }}</p>
        <p><b>Kelas/Jurusan:</b> {{ $siswa->kelas }} / {{ $siswa->jurusan }}</p>

        <h3>Tempat PKL</h3>
        <table>
            <tr>
                <th>Nama Siswa</th>
                <th>Jurusan</th>
                <th>Nama Perusahaan</th>
                <th>Alamat Perusahaan</th>
            </tr>
            @foreach ($siswa->tempats as $tempat)
                <tr>
                    <td>{{ $siswa->nama }}</td>
                    <td>{{ $siswa->jurusan }}</td>
                    <td>{{ $tempat->nama_perusahaan }}</td>
                    <td>{{ $tempat->alamat_perusahaan }}</td>
                </tr>
            @endforeach
        </table>


        <br>
        <a href="{{ route('surat.daftar_siswa_pencarian') }}">Kembali</a>
    </div>
</body>
</html>

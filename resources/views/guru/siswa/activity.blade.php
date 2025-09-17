<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Aktivitas Harian Siswa - Guru</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-4">
    <h3 class="mb-4">Data Aktivitas Harian Siswa</h3>

    @if($siswa->activities->isEmpty())
      <div class="alert alert-info">Belum ada aktivitas.</div>
    @else
      <div class="table-responsive bg-white shadow rounded">
        <table class="table table-striped mb-0">
          <thead class="table-light">
            <tr>
              <th>Tanggal</th>
              <th>Nama Siswa</th>
              <th>Kegiatan</th>
              <th>Foto</th>
            </tr>
          </thead>
          <tbody>
            @foreach($siswa->activities as $a)
              <tr>
                <td>{{ \Carbon\Carbon::parse($a->tanggal)->format('d-m-Y H:i') }}</td>
                <td>{{ $a->siswa->nama ?? '-' }}</td>
                <td style="max-width:400px;">{{ $a->kegiatan }}</td>
                <td>
                  @if($a->foto)
                    <img src="{{ asset('storage/'.$a->foto) }}" style="max-width:120px" alt="foto">
                  @else
                    -
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif

    <a href="{{ route('guru.dashboard') }}" class="btn btn-link mt-3">Kembali</a>
  </div>
</body>
</html>

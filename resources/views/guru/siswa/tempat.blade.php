<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Tempat PKL | SyifaPKL</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

  <style>
    .bg-brand { background-color: #1d9a96; }
    .bg-brand:hover { background-color: #17807c; }
    .text-brand { color: #1d9a96; }
  </style>
</head>
<body class="bg-light">
  <div class="container py-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 class="fw-semibold text-brand">
        <i class="fas fa-building me-2"></i> Daftar Tempat PKL
      </h2>
    </div>

    <!-- Table -->
    <div class="table-responsive bg-white shadow rounded">
      <table class="table table-striped align-middle mb-0">
        <thead class="table-light text-brand">
          <tr>
            <th>No</th>
            <th>Nama Perusahaan</th>
            <th>Alamat</th>
            <th>Status</th>
            <th>Jumlah Siswa</th>
            <th>Nama Siswa</th>
          </tr>
        </thead>
        <tbody>
          @forelse($siswa->tempats as $index => $tempat)
          <tr>
            <td>{{ $index+1 }}</td>
            <td>{{ $tempat->nama_perusahaan }}</td>
            <td>{{ $tempat->alamat_perusahaan }}</td>
            <td>{{ $tempat->status_label }}</td>
            <td>{{ $tempat->siswas->count() }}</td>
            <td>
              @if($tempat->siswas->count())
                <ul class="mb-0 ps-3">
                  @foreach($tempat->siswas as $s)
                    <li>{{ $s->nama }} ({{ $s->jurusan }})</li>
                  @endforeach
                </ul>
              @else
                <em class="text-muted">Belum ada siswa</em>
              @endif
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="6" class="text-center text-muted py-4">
              <i class="fas fa-info-circle"></i> Tidak Ada Data
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <!-- Tombol kembali -->
    <div class="mt-4">
      <a href="{{ route('guru.dashboard') }}" class="text-brand text-decoration-none">
        <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
      </a>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

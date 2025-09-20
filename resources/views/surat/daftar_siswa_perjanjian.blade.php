<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Siswa - Surat Perjanjian Kerjasama | SyifaPKL</title>

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
        <i class="fas fa-users"></i> Daftar Siswa - Surat Perjanjian Kerjasama
      </h2>
    </div>

    <!-- Table -->
    <div class="table-responsive bg-white shadow rounded">
      <table class="table table-striped align-middle mb-0">
        <thead class="table-light text-brand">
          <tr>
            <th>Nama</th>
            <th>Kelas / Jurusan</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($siswas as $siswa)
          <tr>
            <td>{{ $siswa->nama }}</td>
            <td>{{ $siswa->kelas }} / {{ $siswa->jurusan }}</td>
            <td class="text-center">
              <div class="d-flex justify-content-center gap-2">
                <!-- Lihat Template -->
                <a href="{{ route('surat.perjanjian', $siswa->id) }}"
                   class="btn btn-sm btn-outline-success" title="Lihat Template">
                  <i class="fa-solid fa-eye"></i>
                </a>
                <!-- Download PDF -->
                <a href="{{ route('surat.download_perjanjian', $siswa->id) }}"
                   class="btn btn-sm text-white" style="background-color:#d5ad71;" title="Download PDF">
                  <i class="fa-solid fa-file-pdf me-1"></i> Download PDF
                </a>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="3" class="text-center text-muted py-4">
              <i class="fas fa-info-circle"></i> Tidak ada data siswa untuk surat perjanjian.
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <!-- Tombol kembali -->
    <div class="mt-4">
      <a href="{{ route('admin.dashboard')}}" class="text-brand text-decoration-none">
        <i class="fas fa-arrow-left me-1"></i> Kembali ke Dashboard
      </a>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

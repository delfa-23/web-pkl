<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Daftar Daily Activity Siswa | SyifaPKL</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <style>
    .bg-brand { background-color: #1d9a96; }
    .bg-brand:hover { background-color: #17807c; }
    .text-brand { color: #1d9a96; }
    .cursor-pointer { cursor: pointer; }
  </style>
</head>
<body class="bg-light">
  <div class="container py-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2 class="fw-semibold text-brand">
        <i class="fas fa-tasks me-2"></i> Data Aktivitas Harian Siswa
      </h2>
    </div>

    @if($siswa->activities->isEmpty())
      <div class="alert alert-info shadow-sm">
        <i class="fas fa-info-circle me-1"></i> Belum ada aktivitas.
      </div>
    @else
      <div class="table-responsive bg-white shadow rounded">
        <table class="table table-striped align-middle mb-0">
          <thead class="table-light text-brand">
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
                    <img src="{{ asset('storage/'.$a->foto) }}"
                         class="img-thumbnail cursor-pointer"
                         style="max-width:120px"
                         alt="foto"
                         data-bs-toggle="modal"
                         data-bs-target="#fotoModal"
                         onclick="showFoto('{{ asset('storage/'.$a->foto) }}')">
                  @else
                    <em class="text-muted">-</em>
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif

    <!-- Tombol kembali -->
    <div class="mt-4">
      <a href="{{ route('guru.dashboard') }}" class="text-brand text-decoration-none">
        <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
      </a>
    </div>
  </div>

  <!-- Modal Foto -->
  <div class="modal fade" id="fotoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-body p-0">
          <img id="modalFoto" src="" class="img-fluid w-100 rounded" alt="foto besar">
        </div>
      </div>
    </div>
  </div>

  <!-- JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function showFoto(src) {
      document.getElementById('modalFoto').src = src;
    }
  </script>
</body>
</html>

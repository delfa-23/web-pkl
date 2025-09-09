<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daily Activity | SyifaPKL</title>

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
        <i class="fas fa-calendar-day me-2"></i> Daily Activity
      </h2>
      <a href="{{ route('siswa.activity.create') }}" class="btn bg-brand text-white shadow">
        <i class="fas fa-plus me-1"></i> Tambah Aktivitas
      </a>
    </div>

    <!-- Table -->
    <div class="table-responsive bg-white shadow rounded">
      <table class="table table-striped align-middle mb-0">
        <thead class="table-light text-brand">
          <tr>
            <th>Tanggal & Waktu</th>
            <th>Kegiatan</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($activities as $a)
          <tr>
            <td>{{ date('d-m-Y H:i', strtotime($a->tanggal)) }}</td>
            <td>{{ $a->kegiatan }}</td>
            <td class="text-center">
              <div class="d-flex justify-content-center gap-2">
                <!-- Edit -->
                <a href="{{ route('siswa.activity.edit', $a->id) }}"
                   class="btn btn-sm btn-outline-primary" title="Edit">
                  <i class="fas fa-edit"></i>
                </a>
                <!-- Delete -->
                <form action="{{ route('siswa.activity.destroy', $a->id) }}" method="POST"
                      onsubmit="return confirm('Yakin hapus?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                    <i class="fas fa-trash"></i>
                  </button>
                </form>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="3" class="text-center text-muted py-4">
              <i class="fas fa-info-circle"></i> Belum ada aktivitas.
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <!-- Tombol kembali -->
    <div class="mt-4">
      <a href="{{ route('siswa.dashboard') }}" class="text-brand text-decoration-none">
        <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
      </a>
    </div>

  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

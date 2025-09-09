<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Jurusan | SyifaPKL</title>

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
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
      <h2 class="fw-semibold text-brand mb-0">
        <i class="fas fa-book me-2"></i> Data Jurusan
      </h2>
      <a href="{{ route('admin.jurusan.create') }}" class="btn bg-brand text-white shadow">
        <i class="fas fa-plus me-2"></i> Tambah Jurusan
      </a>
    </div>

    <!-- Pesan sukses -->
    @if(session('success'))
      <div class="alert alert-success">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
      </div>
    @endif

    <!-- Form Search -->
    <form action="{{ route('admin.jurusan.index') }}" method="GET" class="row g-2 mb-3">
      <div class="col-md-4">
        <input type="text" name="search" value="{{ request('search') }}" class="form-control"
               placeholder="Cari jurusan...">
      </div>
      <div class="col-auto">
        <button type="submit" class="btn bg-brand text-white">
          <i class="fas fa-search me-1"></i> Cari
        </button>
      </div>
    </form>

    <!-- Tabel -->
    <div class="table-responsive bg-white shadow rounded">
      <table class="table table-striped align-middle mb-0">
        <thead class="table-light text-brand">
          <tr>
            <th>No</th>
            <th>Nama Jurusan</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($jurusan as $index => $j)
          <tr>
            <td>{{ $index+1 }}</td>
            <td>{{ $j->nama_jurusan }}</td>
            <td class="text-center">
              <div class="d-flex justify-content-center gap-2">
                <!-- Edit -->
                <a href="{{ route('admin.jurusan.edit', $j->id) }}"
                   class="btn btn-sm btn-outline-primary" title="Edit">
                  <i class="fas fa-edit"></i>
                </a>
                <!-- Delete -->
                <form action="{{ route('admin.jurusan.destroy', $j->id) }}" method="POST" onsubmit="return confirm('Yakin mau hapus?')">
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
              <i class="fas fa-info-circle me-1"></i> Tidak ada data Jurusan.
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

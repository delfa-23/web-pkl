<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Guru | SyifaPKL</title>

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
        <i class="fas fa-chalkboard-teacher me-2"></i> Data Guru
      </h2>
      <a href="{{ route('admin.guru.create') }}" class="btn bg-brand text-white shadow">
        <i class="fas fa-plus me-2"></i> Tambah Data
      </a>
    </div>
    <!-- Search -->
    <form action="{{ route('admin.guru.index') }}" method="GET" class="row g-2 mb-3">
      <div class="col-md-4">
        <input type="text" name="search" value="{{ request('search') }}" class="form-control"
               placeholder="Cari Guru...">
      </div>
      <div class="col-auto">
        <button type="submit" class="btn bg-brand text-white">
          <i class="fas fa-search me-1"></i> Cari
        </button>
      </div>
    </form>

    <!-- Table -->
    <div class="table-responsive bg-white shadow rounded">
      <table class="table table-striped align-middle mb-0">
        <thead class="table-light text-brand">
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>NIP</th>
            <th>NUPTK</th>
            <th>Jabatan</th>
            <th>Dibuat</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($guru as $index => $g)
          <tr>
            <td>{{ $index+1 }}</td>
            <td>{{ $g->nama }}</td>
            <td>{{ $g->nip ?? '-' }}</td>
            <td>{{ $g->nuptk ?? '-' }}</td>
            <td>{{ $g->jabatan }}</td>
            <td>{{ $g->created_at->format('d, M Y') }}</td>
            <td class="text-center">
              <div class="d-flex justify-content-center gap-2">
                <!-- Edit -->
                <a href="{{ route('admin.guru.edit', $g->id) }}"
                   class="btn btn-sm btn-outline-primary" title="Edit">
                  <i class="fas fa-edit"></i>
                </a>
                <!-- Delete -->
                <form id="delete-form-{{ $g->id }}"
                    action="{{ route('admin.guru.destroy', $g->id) }}"
                    method="POST" style="display:none;">
                    @csrf
                    @method('DELETE')
                </form>
                <button type="button" class="btn btn-sm btn-outline-danger" title="Hapus" onclick="deleteUser({{ $g->id }})">
                <i class="fas fa-trash"></i>
                </button>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="7" class="text-center text-muted py-4">
              <i class="fas fa-info-circle"></i> Tidak Ada Data
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <!-- Tombol kembali -->
    <div class="mt-4">
      <a href="{{ route('admin.dashboard')}}" class="text-brand text-decoration-none">
        <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
      </a>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
  function deleteUser(id) {
    Swal.fire({
        title: 'Yakin?',
        text: "Data Tidak Bisa Dikembalikan Setelah Dihapus!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Delete!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    })
}
</script>
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: '{{ session('success') }}',
        timer: 2000,
        showConfirmButton: false
    })
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: '{{ session('error') }}',
    })
</script>
@endif
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Siswa | SyifaPKL</title>

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
      <h2 class="fw-semibold text-brand mb-0">
        <i class="fas fa-users me-2"></i> Data Siswa
      </h2>
      <a href="{{ route('admin.siswa.create') }}" class="btn bg-brand text-white shadow">
        <i class="fas fa-plus me-2"></i> Tambah Siswa
      </a>
    </div>

    <!-- Form Search -->
    <form action="{{ route('admin.siswa.index') }}" method="GET" class="row g-2 mb-3">
      <div class="col-md-4">
        <input type="text" name="search" value="{{ request('search') }}" class="form-control"
               placeholder="Cari siswa...">
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
            <th>Nama Lengkap</th>
            <th>NIS</th>
            <th>NISN</th>
            <th>Kelas</th>
            <th>Jurusan</th>
            <th>Telepon</th>
            <th>ID Login</th>
            <th>Status</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($siswas as $index => $siswa)
          <tr>
            <td>{{ $index+1 }}</td>
            <td>{{ $siswa->nama }}</td>
            <td>{{ $siswa->nis ?? '-' }}</td>
            <td>{{ $siswa->nisn ?? '-' }}</td>
            <td>{{ $siswa->kelas }}</td>
            <td>{{ $siswa->jurusan }}</td>
            <td>{{ $siswa->telepon ?? '-' }}</td>
            <td>{{ $siswa->login->id_login }}</td>
            <td>
              @if($siswa->status == 'Aktif')
                <span class="badge bg-success">Aktif</span>
              @else
                <span class="badge bg-danger">Nonaktif</span>
              @endif
            </td>
            <td class="text-center">
              <div class="d-flex justify-content-center gap-2">
                <!-- Edit -->
                <a href="{{ route('admin.siswa.edit', $siswa->id) }}"
                   class="btn btn-sm btn-outline-primary" title="Edit">
                  <i class="fas fa-edit"></i>
                </a>
                <!-- Delete -->
                <form id="delete-form-{{ $siswa->id }}"
                    action="{{ route('admin.siswa.destroy', $siswa->id) }}"
                    method="POST" style="display:none;">
                    @csrf
                    @method('DELETE')
                </form>
                <button type="button" class="btn btn-sm btn-outline-danger" title="Hapus" onclick="deleteUser({{ $siswa->id }})">
                <i class="fas fa-trash"></i>
                </button>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="10" class="text-center text-muted py-4">
              <i class="fas fa-info-circle me-1"></i> Tidak ada data siswa.
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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tempat PKL | SyifaPKL</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        .bg-brand {
            background-color: #1d9a96;
        }

        .bg-brand:hover {
            background-color: #17807c;
        }

        .text-brand {
            color: #1d9a96;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container py-4">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-semibold text-brand">
                <i class="fas fa-building me-2"></i> Tempat PKL
            </h2>
        </div>

        <div class="table-responsive bg-white shadow rounded">
            @if ($tempat->count() > 0)
                <table class="table table-striped align-middle mb-0">
                    <thead class="table-light text-brand">
                        <tr>
                            <th>Nama Perusahaan</th>
                            <th>Alamat</th>
                            <th>Telepon</th>
                            <th>Instruktur</th>
                            <th>Pembimbing</th> {{-- Kolom baru --}}
                            <th>Siswa</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tempat as $t)
                            <tr>
                                <td>{{ $t->nama_perusahaan }}</td>
                                <td>{{ $t->alamat_perusahaan }}</td>
                                <td>{{ $t->telepon_perusahaan }}</td>
                                <td>{{ $t->instruktur_perusahaan ?? 'Belum ada instruktur'}}</td>
                                <td>{{ $t->pembimbing_perusahaan ?? 'Belum ada Pembimbing' }}</td> {{-- Kolom baru --}}
                                <td>
                                    <ul class="mb-0 ps-3">
                                        @foreach ($t->siswas as $anggota)
                                            <li>{{ $anggota->nama }} ({{ $anggota->jurusan }})</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    @if ($t->status == 'belum_terverifikasi')
                                        <span class="badge bg-secondary">Belum Terverifikasi</span>
                                    @elseif($t->status == 'proses')
                                        <span class="badge bg-warning text-dark">Proses</span>
                                    @elseif($t->status == 'diterima')
                                        <span class="badge bg-success">Diterima</span>
                                    @elseif($t->status == 'ditolak')
                                        <span class="badge bg-danger">Ditolak</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <!-- Tombol Edit -->
                                        <a href="{{ route('siswa.tempat.edit', $t->id) }}"
                                            class="btn btn-sm btn-outline-primary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <!-- Tombol Hapus -->
                                        <form id="delete-form-{{ $t->id }}"
                                            action="{{ route('siswa.tempat.destroy', $t->id) }}" method="POST"
                                            style="display:none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        <button type="button" class="btn btn-sm btn-outline-danger" title="Hapus"
                                            onclick="deleteUser({{ $t->id }})">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <!-- Kalau belum punya tempat PKL -->
                <div class="text-center py-5">
                    <a href="{{ route('siswa.tempat.create') }}" class="btn bg-brand text-white shadow">
                        <i class="fas fa-plus me-1"></i> Input Tempat PKL
                    </a>
                </div>
            @endif
        </div>



        <!-- Tombol kembali -->
        <div class="mt-4">
            <a href="{{ route('siswa.dashboard') }}" class="text-brand text-decoration-none">
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
    @if (session('success'))
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

    @if (session('error'))
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

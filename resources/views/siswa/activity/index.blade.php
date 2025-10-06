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
                <i class="fas fa-calendar-day me-2"></i> Daily Activity
            </h2>
            <a href="{{ route('siswa.activity.create') }}" class="btn bg-brand text-white shadow">
                <i class="fas fa-plus me-1"></i> Tambah Aktivitas
            </a>
        </div>

        <!-- Info Siswa & PKL -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h5 class="fw-bold text-brand mb-3"><i class="fas fa-user-graduate me-2"></i> Informasi PKL</h5>
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <strong>Program Keahlian:</strong> {{ $siswa->jurusan ?? '-' }}
                    </div>
                    <div class="col-md-6 mb-2">
                        <strong>Nama Siswa:</strong> {{ $siswa->nama }}
                    </div>
                    <div class="col-md-6 mb-2">
                        <strong>Nama Perusahaan:</strong>
                        {{ $siswa->tempats->first()->nama_perusahaan ?? '-' }}
                    </div>
                    <div class="col-md-6 mb-2">
                        <strong>Nama Pembimbing:</strong>
                        {{ $siswa->tempats->first()->guru->nama ?? '-' }}
                    </div>
                </div>
            </div>
        </div>


        <!-- Table -->
        <div class="table-responsive bg-white shadow rounded">
            <table class="table table-striped align-middle mb-0">
                <thead class="table-light text-brand">
                    <tr>
                        <th>Tanggal</th>
                        <th>Waktu Mulai</th>
                        <th>Waktu Selesai</th>
                        <th>Kegiatan</th>
                        <th>Deskripsi</th>
                        <th>Foto</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($activities as $a)
                        <tr>
                            <!-- Tanggal -->
                            <td>{{ date('d-m-Y', strtotime($a->tanggal)) }}</td>

                            <!-- Waktu mulai -->
                            <td>{{ date('H:i', strtotime($a->waktu_mulai)) }}</td>

                            <!-- Waktu selesai -->
                            <td>{{ date('H:i', strtotime($a->waktu_selesai)) }}</td>

                            <!-- Kegiatan -->
                            <td>{{ $a->kegiatan }}</td>

                            <!-- Deskripsi -->
                            <td>{{ $a->deskripsi ?? '-' }}</td>

                            <!-- Foto -->
                            <td class="text-center">
                                @if ($a->foto)
                                    <img src="{{ asset('storage/' . $a->foto) }}" alt="Foto Aktivitas"
                                        class="img-thumbnail" style="max-width: 100px;">
                                @else
                                    <span class="text-muted">Tidak ada foto</span>
                                @endif
                            </td>

                            <!-- Aksi -->
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <!-- Edit -->
                                    <a href="{{ route('siswa.activity.edit', $a->id) }}"
                                        class="btn btn-sm btn-outline-primary" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <!-- Delete -->
                                    <form id="delete-form-{{ $a->id }}"
                                        action="{{ route('siswa.activity.destroy', $a->id) }}" method="POST"
                                        style="display:none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <button type="button" class="btn btn-sm btn-outline-danger" title="Hapus"
                                        onclick="deleteUser({{ $a->id }})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
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

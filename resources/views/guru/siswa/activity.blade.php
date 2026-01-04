<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Daftar Daily Activity Siswa | SyifaPKL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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

        .cursor-pointer {
            cursor: pointer;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container py-4">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-semibold text-brand">
                <i class="fas fa-tasks me-2"></i> Data Aktivitas Harian Siswa
            </h2>
            <div class="d-flex gap-2">
                <a href="{{ route('guru.daily.export', $siswa->id) }}" class="btn btn-success btn-sm">
                    <i class="fas fa-file-excel me-1"></i> Export Excel
                </a>

                <a href="{{ route('guru.dashboard') }}" class="btn bg-brand text-white shadow-sm">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>

        </div>

        @if ($siswa->activities->isEmpty())
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
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($siswa->activities as $a)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($a->tanggal)->format('d-m-Y') }}</td>
                                <td>{{ $a->siswa->nama ?? '-' }}</td>

                                <td style="max-width:400px;">
                                    {{ $a->kegiatan }}

                                    @if ($a->catatan_pembina)
                                        <div class="text-danger small mt-1">
                                            <strong>Catatan:</strong> {{ $a->catatan_pembina }}
                                        </div>
                                    @endif
                                </td>

                                <td>
                                    @if ($a->foto)
                                        <img src="{{ asset('storage/' . $a->foto) }}"
                                            class="img-thumbnail cursor-pointer" style="max-width:120px"
                                            data-bs-toggle="modal" data-bs-target="#fotoModal"
                                            onclick="showFoto('{{ asset('storage/' . $a->foto) }}')">
                                    @else
                                        <em>-</em>
                                    @endif
                                </td>

                                <!-- STATUS -->
                                <td>
                                    @if ($a->status_verifikasi === 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @elseif($a->status_verifikasi === 'diterima')
                                        <span class="badge bg-success">Diterima</span>
                                    @else
                                        <span class="badge bg-danger">Ditolak</span>
                                    @endif
                                </td>

                                <!-- AKSI VERIFIKASI -->
                                <td style="min-width:220px">
                                    <form action="{{ route('guru.activity.verifikasi', $a->id) }}" method="POST">
                                        @csrf

                                        <select name="status_verifikasi" class="form-select form-select-sm mb-2">
                                            <option value="pending"
                                                {{ $a->status_verifikasi == 'pending' ? 'selected' : '' }}>
                                                Pending
                                            </option>
                                            <option value="diterima"
                                                {{ $a->status_verifikasi == 'diterima' ? 'selected' : '' }}>
                                                Diterima
                                            </option>
                                            <option value="ditolak"
                                                {{ $a->status_verifikasi == 'ditolak' ? 'selected' : '' }}>
                                                Ditolak
                                            </option>
                                        </select>

                                        <textarea name="catatan_pembina" class="form-control form-control-sm mb-2"
                                            placeholder="Catatan pembimbing (wajib jika ditolak)">{{ $a->catatan_pembina }}</textarea>

                                        <button class="btn btn-sm btn-success w-100">
                                            Simpan Verifikasi
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
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

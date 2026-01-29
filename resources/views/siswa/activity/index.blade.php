<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Activity | SyifaPKL</title>

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
    </style>
</head>

<body class="bg-light">
    <div class="container py-4">

        <!-- HEADER -->
        <div class="d-flex justify-content-between align-items-center mb-3">

            {{-- JUDUL --}}
            <h2 class="fw-semibold text-brand mb-0">
                <i class="fas fa-calendar-day me-2"></i> Daily Activity
            </h2>

            {{-- AKSI --}}
            <div class="d-flex gap-2">

                {{-- KEMBALI --}}
                <a href="{{ route('siswa.dashboard') }}" class="btn bg-brand text-white">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>

                {{-- TAMBAH --}}
                <a href="{{ route('siswa.activity.create') }}" class="btn bg-brand text-white">
                    <i class="fas fa-plus me-1"></i> Tambah
                </a>

            </div>
        </div>


        {{-- ALERT STATUS --}}
        @if ($unverifiedActivities->count())
            <div class="alert alert-warning">
                <strong>{{ $unverifiedActivities->count() }}</strong> daily activity belum diterima pembimbing:
                <ul class="mb-0 mt-2">
                    @foreach ($unverifiedActivities as $activity)
                        <li>
                            {{ \Carbon\Carbon::parse($activity->tanggal)->format('d-m-Y') }}
                            —
                            @if ($activity->status_verifikasi === 'pending')
                                <span class="badge bg-warning text-dark">MENUNGGU</span>
                            @else
                                <span class="badge bg-danger">DITOLAK</span>
                                <a href="{{ route('siswa.activity.edit', $activity->id) }}"
                                    class="ms-1 text-decoration-underline">
                                    Perbaiki
                                </a>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- INFO PKL -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h5 class="fw-bold text-brand mb-3">
                    <i class="fas fa-user-graduate me-2"></i> Informasi PKL
                </h5>
                <div class="row">
                    <div class="col-md-6 mb-2"><strong>Nama Siswa:</strong> {{ $siswa->nama }}</div>
                    <div class="col-md-6 mb-2"><strong>Jurusan:</strong> {{ $siswa->jurusan }}</div>
                    <div class="col-md-6 mb-2">
                        <strong>Perusahaan:</strong>
                        {{ $siswa->tempats->first()->nama_perusahaan ?? '-' }}
                    </div>
                    <div class="col-md-6 mb-2">
                        <strong>Pembimbing:</strong>
                        {{ $siswa->tempats->first()->guru->nama ?? '-' }}
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h6 class="text-muted mb-1">Total Jurnal Terisi</h6>
                        <h3 class="fw-bold text-brand mb-0">
                            {{ $activities->count() }}
                        </h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h6 class="text-muted mb-1">Sudah Diterima</h6>
                        <h3 class="fw-bold text-success mb-0">
                            {{ $activities->where('status_verifikasi', 'diterima')->count() }}
                        </h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h6 class="text-muted mb-1">Belum Diterima</h6>
                        <h3 class="fw-bold text-warning mb-0">
                            {{ $unverifiedActivities->count() }}
                        </h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- TABLE -->
        <div class="table-responsive bg-white shadow rounded">
            <table class="table table-striped align-middle mb-0">
                <thead class="table-light text-brand">
                    <tr>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Kegiatan</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                        <th>Foto</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($activities as $a)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($a->tanggal)->format('d-m-Y') }}</td>

                            <td>{{ $a->waktu_mulai }} - {{ $a->waktu_selesai }}</td>

                            <td>{{ $a->kegiatan }}</td>

                            <td>
                                {{ $a->deskripsi }}

                                {{-- CATATAN PEMBIMBING --}}
                                @if ($a->catatan_pembina && $a->status_verifikasi !== 'pending')
                                    <div class="alert alert-danger py-1 px-2 mt-2 mb-0">
                                        <small>
                                            <strong>Catatan Pembimbing:</strong><br>
                                            {{ $a->catatan_pembina }}
                                        </small>
                                    </div>
                                @endif
                            </td>


                            {{-- STATUS --}}
                            <td>
                                @if ($a->status_verifikasi === 'pending')
                                    <span class="badge bg-warning text-dark">
                                        <i class="fas fa-clock me-1"></i> Pending
                                    </span>
                                @elseif ($a->status_verifikasi === 'diterima')
                                    <span class="badge bg-success">
                                        <i class="fas fa-check-circle me-1"></i> Diterima
                                    </span>
                                @else
                                    <span class="badge bg-danger">
                                        <i class="fas fa-times-circle me-1"></i> Ditolak
                                    </span>
                                @endif
                            </td>

                            {{-- FOTO --}}
                            <td>
                                <img src="{{ asset('storage/' . $a->foto) }}" class="img-thumbnail"
                                    style="max-width:90px">
                            </td>

                            {{-- AKSI --}}
                            <td class="text-center">
                                @if ($a->status_verifikasi === 'diterima')
                                    <span class="text-success">
                                        <i class="fas fa-lock me-1"></i> Terkunci
                                    </span>
                                @else
                                    <a href="{{ route('siswa.activity.edit', $a->id) }}"
                                        class="btn btn-sm btn-outline-primary" title="Edit aktivitas">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                Belum ada activity
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</body>

</html>

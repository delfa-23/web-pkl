<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kegiatan Siswa | Monitoring PKL</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --brand-primary: #1d9a96;
            --brand-primary-dark: #17807c;
            --brand-secondary: #f8f9fa;
        }

        .bg-brand {
            background-color: var(--brand-primary);
        }

        .bg-brand:hover {
            background-color: var(--brand-primary-dark);
        }

        .text-brand {
            color: var(--brand-primary);
        }

        .filter-card {
            background-color: #f9f9f9;
            border-left: 4px solid var(--brand-primary);
        }

        .table-light th {
            background-color: #f0f7f7;
            border-bottom: 2px solid var(--brand-primary);
            font-weight: 600;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(29, 154, 150, 0.05);
        }

        .img-thumbnail-sm {
            width: 80px;
            height: 60px;
            object-fit: cover;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .img-thumbnail-sm:hover {
            transform: scale(1.05);
        }

        .badge-pending {
            background-color: #ffc107;
            color: #000;
            padding: 0.4em 0.8em;
        }

        .badge-approved {
            background-color: #198754;
            color: #fff;
            padding: 0.4em 0.8em;
        }

        .badge-rejected {
            background-color: #dc3545;
            color: #fff;
            padding: 0.4em 0.8em;
        }

        .btn-outline-brand {
            color: var(--brand-primary);
            border-color: var(--brand-primary);
        }

        .btn-outline-brand:hover {
            background-color: var(--brand-primary);
            color: white;
        }

        .form-label {
            font-weight: 500;
            font-size: 0.9rem;
            color: #495057;
        }

        .form-control, .form-select {
            font-size: 0.9rem;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container-fluid py-4">
        <!-- Header dengan Tombol Kembali -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-semibold text-brand mb-1">
                    <i class="fas fa-calendar-check me-2"></i> Data Kegiatan Harian Siswa
                </h2>
                <p class="text-muted mb-0">
                    <i class="fas fa-info-circle me-1"></i>
                    Monitoring kegiatan harian siswa PKL
                </p>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('admin.daily') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-sync-alt me-2"></i> Refresh
                </a>
                <a href="{{ route('admin.dashboard') }}" class="btn bg-brand text-white">
                    <i class="fas fa-arrow-left me-2"></i> Kembali
                </a>
            </div>
        </div>

        <!-- Form Filter -->
        <div class="card shadow-sm mb-4 filter-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title text-brand mb-0">
                        <i class="fas fa-filter me-2"></i> Filter Data
                    </h5>
                    <span class="badge bg-light text-dark">
                        <i class="fas fa-database me-1"></i>
                        {{ $activities->total() }} Data Ditemukan
                    </span>
                </div>

                <form method="GET" id="filterForm" class="row g-3">
                    <!-- Filter Tanggal -->
                    <div class="col-md-3">
                        <label class="form-label">
                            <i class="far fa-calendar-alt me-1"></i> Tanggal
                        </label>
                        <input type="date" name="tanggal" class="form-control form-control-sm"
                               value="{{ request('tanggal') }}"
                               id="dateFilter">
                    </div>

                    <!-- Filter Guru Pembimbing -->
                    <div class="col-md-3">
                        <label class="form-label">
                            <i class="fas fa-chalkboard-teacher me-1"></i> Guru Pembimbing
                        </label>
                        <select id="guru_id" name="guru_id" class="form-select form-select-sm">
                            <option value="">Semua Guru</option>
                            @foreach ($gurus as $guru)
                                <option value="{{ $guru->id }}"
                                    {{ request('guru_id') == $guru->id ? 'selected' : '' }}>
                                    {{ $guru->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Filter Siswa -->
                    <div class="col-md-3">
                        <label class="form-label">
                            <i class="fas fa-user-graduate me-1"></i> Siswa
                        </label>
                        <select id="siswa_id" name="siswa_id" class="form-select form-select-sm">
                            <option value="">Semua Siswa</option>
                            @foreach ($siswas as $siswa)
                                <option value="{{ $siswa->login_id }}"
                                    {{ request('siswa_id') == $siswa->login_id ? 'selected' : '' }}>
                                    {{ $siswa->nama }} ({{ $siswa->kelas ?? 'N/A' }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Filter Status -->
                    <div class="col-md-3">
                        <label class="form-label">
                            <i class="fas fa-check-circle me-1"></i> Status Verifikasi
                        </label>
                        <select name="status_verifikasi" class="form-select form-select-sm">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status_verifikasi') == 'pending' ? 'selected' : '' }}>
                                <i class="fas fa-clock me-1"></i> Menunggu
                            </option>
                            <option value="diterima" {{ request('status_verifikasi') == 'diterima' ? 'selected' : '' }}>
                                <i class="fas fa-check me-1"></i> Diterima
                            </option>
                            <option value="ditolak" {{ request('status_verifikasi') == 'ditolak' ? 'selected' : '' }}>
                                <i class="fas fa-times me-1"></i> Ditolak
                            </option>
                        </select>
                    </div>

                    <!-- Action Buttons -->
                    <div class="col-12 mt-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-sm bg-brand text-white px-4">
                                    <i class="fas fa-search me-1"></i> Terapkan Filter
                                </button>
                                <a href="{{ route('admin.daily') }}" class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-redo me-1"></i> Reset Filter
                                </a>
                            </div>

                            @if(request()->anyFilled(['tanggal', 'guru_id', 'siswa_id', 'status_verifikasi']))
                            <div class="text-muted small">
                                <i class="fas fa-filter me-1"></i>
                                Filter Aktif:
                                @if(request('tanggal'))
                                    <span class="badge bg-info me-1">Tanggal: {{ request('tanggal') }}</span>
                                @endif
                                @if(request('guru_id'))
                                    <span class="badge bg-info me-1">Guru: {{ $gurus->where('id', request('guru_id'))->first()->nama ?? '' }}</span>
                                @endif
                                @if(request('siswa_id'))
                                    <span class="badge bg-info me-1">Siswa: {{ $siswas->where('login_id', request('siswa_id'))->first()->nama ?? '' }}</span>
                                @endif
                                @if(request('status_verifikasi'))
                                    <span class="badge bg-info me-1">Status: {{ ucfirst(request('status_verifikasi')) }}</span>
                                @endif
                            </div>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabel Data -->
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                @if($activities->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped table-bordered align-middle table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th width="100">Tanggal</th>
                                <th width="120">Waktu</th>
                                <th>Siswa</th>
                                <th>Kelas</th>
                                <th>Guru Pembimbing</th>
                                <th>Kegiatan</th>
                                <th>Deskripsi</th>
                                <th width="100" class="text-center">Foto</th>
                                <th width="120">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($activities as $item)
                                <tr>
                                    <td>
                                        <div class="fw-semibold">
                                            {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}
                                        </div>
                                        <div class="small text-muted">
                                            {{ \Carbon\Carbon::parse($item->tanggal)->locale('id')->dayName }}
                                        </div>
                                    </td>

                                    <td>
                                        <div class="d-flex flex-column align-items-center">
                                            <span class="badge bg-light text-dark">{{ $item->waktu_mulai }}</span>
                                            <small class="text-muted my-1">hingga</small>
                                            <span class="badge bg-light text-dark">{{ $item->waktu_selesai }}</span>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="fw-semibold">{{ $item->siswa->nama ?? '-' }}</div>
                                        <div class="small text-muted">
                                            <i class="fas fa-id-card me-1"></i>
                                            NIS: {{ $item->siswa->nis ?? '-' }}
                                        </div>
                                    </td>

                                    <td>
                                        <span class="badge bg-info bg-opacity-10 text-info border border-info">
                                            {{ $item->siswa->kelas ?? '-' }}
                                        </span>
                                        <div class="small text-muted mt-1">
                                            {{ $item->siswa->jurusan ?? '-' }}
                                        </div>
                                    </td>

                                    <td>
                                        <div class="fw-semibold">{{ $item->siswa->guru->nama ?? '-' }}</div>
                                        <div class="small text-muted">
                                            <i class="fas fa-user-tag me-1"></i>
                                            {{ $item->siswa->guru->jabatan ?? '' }}
                                        </div>
                                    </td>

                                    <td>
                                        <div class="fw-semibold">{{ $item->kegiatan }}</div>
                                        @if($item->lokasi)
                                        <div class="small text-muted">
                                            <i class="fas fa-map-marker-alt me-1"></i>
                                            {{ $item->lokasi }}
                                        </div>
                                        @endif
                                    </td>

                                    <td style="max-width: 200px;">
                                        <div class="text-truncate" title="{{ $item->deskripsi }}">
                                            {{ Str::limit($item->deskripsi, 80) }}
                                        </div>
                                        @if(strlen($item->deskripsi) > 80)
                                        <button type="button" class="btn btn-link btn-sm p-0 mt-1 small"
                                                data-bs-toggle="modal"
                                                data-bs-target="#descModal{{ $loop->index }}">
                                            <i class="fas fa-eye me-1"></i> Lihat Lengkap
                                        </button>

                                        <!-- Modal untuk Deskripsi Lengkap -->
                                        <div class="modal fade" id="descModal{{ $loop->index }}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">
                                                            <i class="fas fa-align-left me-2"></i>Deskripsi Kegiatan
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p class="fw-semibold">{{ $item->kegiatan }}</p>
                                                        <p>{{ $item->deskripsi }}</p>
                                                        <hr>
                                                        <div class="small text-muted">
                                                            <div><i class="fas fa-calendar me-2"></i> {{ \Carbon\Carbon::parse($item->tanggal)->format('d F Y') }}</div>
                                                            <div><i class="fas fa-clock me-2"></i> {{ $item->waktu_mulai }} - {{ $item->waktu_selesai }}</div>
                                                            <div><i class="fas fa-user me-2"></i> {{ $item->siswa->nama ?? '-' }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        @if ($item->foto)
                                            <button type="button" class="btn btn-link p-0"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#fotoModal{{ $loop->index }}">
                                                <img src="{{ asset('storage/' . $item->foto) }}"
                                                     class="img-thumbnail-sm"
                                                     alt="Foto Kegiatan">
                                            </button>

                                            <!-- Modal untuk Foto -->
                                            <div class="modal fade" id="fotoModal{{ $loop->index }}" tabindex="-1">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">
                                                                <i class="fas fa-camera me-2"></i>Foto Dokumentasi
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            <img src="{{ asset('storage/' . $item->foto) }}"
                                                                 class="img-fluid rounded"
                                                                 alt="Foto Kegiatan">
                                                            <div class="mt-3 small text-muted">
                                                                <div><strong>{{ $item->kegiatan }}</strong></div>
                                                                <div>{{ $item->siswa->nama ?? '-' }} • {{ $item->siswa->kelas ?? '' }}</div>
                                                                <div>{{ \Carbon\Carbon::parse($item->tanggal)->format('d F Y') }}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <span class="badge bg-secondary bg-opacity-10 text-secondary">
                                                <i class="fas fa-image me-1"></i> Tidak ada
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($item->status_verifikasi === 'diterima')
                                            <span class="badge badge-approved rounded-pill d-inline-flex align-items-center">
                                                <i class="fas fa-check-circle me-1"></i> Diterima
                                            </span>
                                            @if($item->verified_at)
                                            <div class="small text-muted mt-1">
                                                <i class="far fa-clock me-1"></i>
                                                {{ \Carbon\Carbon::parse($item->verified_at)->format('d/m H:i') }}
                                            </div>
                                            @endif
                                        @elseif ($item->status_verifikasi === 'ditolak')
                                            <span class="badge badge-rejected rounded-pill d-inline-flex align-items-center">
                                                <i class="fas fa-times-circle me-1"></i> Ditolak
                                            </span>
                                            @if($item->catatan_penolakan)
                                            <div class="small text-danger mt-1" data-bs-toggle="tooltip"
                                                 title="{{ $item->catatan_penolakan }}">
                                                <i class="fas fa-comment-alt me-1"></i> Ada catatan
                                            </div>
                                            @endif
                                        @else
                                            <span class="badge badge-pending rounded-pill d-inline-flex align-items-center">
                                                <i class="fas fa-clock me-1"></i> Menunggu
                                            </span>
                                            <div class="small text-muted mt-1">
                                                <i class="fas fa-hourglass-half me-1"></i>
                                                {{ $item->created_at->diffForHumans() }}
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($activities->hasPages())
                <div class="card-footer bg-white border-top">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="small text-muted">
                            Menampilkan {{ $activities->firstItem() }} - {{ $activities->lastItem() }} dari {{ $activities->total() }} data
                        </div>
                        <div>
                            {{ $activities->withQueryString()->links() }}
                        </div>
                    </div>
                </div>
                @endif

                @else
                <!-- Empty State -->
                <div class="text-center py-5">
                    <div class="mb-3">
                        <i class="fas fa-calendar-times fa-3x text-muted"></i>
                    </div>
                    <h5 class="text-muted mb-2">Tidak ada data kegiatan</h5>
                    <p class="text-muted mb-3">
                        Tidak ditemukan data kegiatan dengan filter yang dipilih
                    </p>
                    <a href="{{ route('admin.daily') }}" class="btn btn-outline-brand">
                        <i class="fas fa-redo me-2"></i> Tampilkan Semua Data
                    </a>
                </div>
                @endif
            </div>
        </div>

        <!-- Footer Info -->
        <div class="mt-3 text-center small text-muted">
            <p class="mb-0">
                <i class="fas fa-calendar-alt me-1"></i>
                Sistem Monitoring PKL • Data per {{ now()->format('d F Y, H:i') }}
            </p>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto submit form on filter change
            const form = document.getElementById('filterForm');
            const filterElements = form.querySelectorAll('select, input[type="date"]');

            filterElements.forEach(el => {
                el.addEventListener('change', () => {
                    form.submit();
                });
            });

            // Set today's date as default if date filter is empty
            const dateFilter = document.getElementById('dateFilter');
            if (!dateFilter.value) {
                const today = new Date().toISOString().split('T')[0];
            }

            // Initialize tooltips
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Auto focus on first filter
            filterElements[0].focus();
        });
    </script>
</body>
</html>

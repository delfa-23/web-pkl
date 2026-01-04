<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mutabaah Yaumiyyah | SyifaPKL</title>

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

<div class="container py-5" style="max-width: 720px;">

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">

            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="fw-semibold text-brand mb-1">
                        <i class="fas fa-book-open me-2"></i> Mutabaah Yaumiyyah
                    </h4>
                    <small class="text-muted">
                        Laporan ibadah harian siswa
                    </small>
                </div>

                <a href="{{ route('siswa.dashboard') }}"
                   class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>

            <!-- Informasi -->
            <div class="alert alert-light border mb-4">
                <i class="fas fa-info-circle me-2 text-brand"></i>
                Silakan mengisi mutabaah yaumiyyah harian melalui formulir resmi yang telah disediakan oleh sekolah.
                Pengisian dilakukan secara <strong>mandiri, jujur, dan rutin setiap hari</strong>.
            </div>

            <!-- Tombol Aksi -->
            <div class="d-grid">
                <a href="https://forms.gle/u9CZH5u6bPnxu3Se7"
                   target="_blank"
                   class="btn bg-brand text-white btn-lg rounded-3">
                    <i class="fas fa-external-link-alt me-2"></i>
                    Isi Mutabaah Yaumiyyah
                </a>
            </div>

        </div>
    </div>

</div>

</body>
</html>

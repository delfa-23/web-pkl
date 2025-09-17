{{-- {{-- <h1>Selamat Datang, {{ $guru->nama }}!</h1>

<h3>Filter Siswa</h3>
<form method="GET" action="{{ route('guru.dashboard') }}">
    <input type="text" name="nama" placeholder="Cari nama siswa" value="{{ request('nama') }}">
    <select name="jurusan">
        <option value="">Semua Jurusan</option>
        <option value="RPL" {{ request('jurusan')=='RPL' ? 'selected' : '' }}>RPL</option>
        <option value="DKV" {{ request('jurusan')=='DKV' ? 'selected' : '' }}>DKV</option>
        <!-- Tambahkan jurusan lain sesuai db -->
    </select>
    <button type="submit">Filter</button>
</form>

<h2>Daftar Siswa</h2>
<table border="1" cellpadding="5">
    <tr>
        <th>Nama</th>
        <th>Jurusan</th>
        <th>Aksi</th>
    </tr>
    @foreach($semuaSiswa as $s)
    <tr>
        <td>{{ $s->nama }}</td>
        <td>{{ $s->jurusan }}</td>
        <td>
            <a href="{{ route('guru.siswa.tempat', $s->id) }}">Lihat Tempat PKL</a> |
            <a href="{{ route('guru.siswa.activity', $s->id) }}">Lihat Daily Activity</a>
        </td>
    </tr>

    @endforeach
</table>
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form> --}}








<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Guru | SyifaPKL</title>

    <!-- Fonts & Styles -->
    <link href="{{ asset('storage/assets/sbadmin2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
    <link href="{{ asset('storage/assets/sbadmin2/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color:#1d9a96;">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-text mx-3">SYIFAPKL</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('guru.dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Divider -->
            {{-- <hr class="sidebar-divider"> --}}

            <!-- Menu khusus siswa -->
            {{-- <li class="nav-item">
                <a class="nav-link" href="{{ route('siswa.tempat.index') }}">
                    <i class="fas fa-building"></i>
                    <span>Data Siswa</span>
                </a>
            </li> --}}

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- User Info -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    Hi, <b>{{ $guru->nama }}</b>
                                </span>
                                <img class="img-profile rounded-circle"
                                     src="{{ asset('storage/assets/img/undraw_male-avatar_zkzx.svg') }}">
                            </a>
                            <!-- Dropdown -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">Dashboard Guru</h1>

                    <div class="row">
                        <!-- Card Tempat PKL -->
                        <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Siswa</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{ $jumlahTempat ?? 0 }}
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h3 class="mb-3">Filter Siswa</h3>
<form method="GET" action="{{ route('guru.dashboard') }}" class="form-inline mb-4">
    <input type="text" name="nama" class="form-control mr-2 mb-2"
           placeholder="Cari nama siswa" value="{{ request('nama') }}">
    <select name="jurusan" class="form-control mr-2 mb-2">
        <option value="">Semua Jurusan</option>
        <option value="RPL" {{ request('jurusan')=='RPL' ? 'selected' : '' }}>RPL</option>
        <option value="DKV" {{ request('jurusan')=='DKV' ? 'selected' : '' }}>DKV</option>
        <!-- Tambahkan jurusan lain sesuai db -->
    </select>
    <button type="submit" class="btn btn-primary mb-2" >Filter</button>
</form>

<!-- Card Tabel Siswa -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold" style="color:#1d9a96;">Daftar Siswa</h6>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered align-middle text-center" width="100%" cellspacing="0"
                   style="border-radius: 10px; overflow:hidden;">
                <thead style="background-color:#1d9a96; color:white;">
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Nama</th>
                        <th>Jurusan</th>
                        <th style="width: 200px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($semuaSiswa as $index => $siswa)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $siswa->nama }}</td>
                            <td>{{ $siswa->jurusan }}</td>
                            <td>
                                <a href="{{ route('guru.siswa.tempat', $siswa->id) }}"
                                   class="btn btn-sm me-1"
                                   style="border:1px solid #1d9a96; color:#1d9a96;">
                                    <i class="fas fa-building"></i> Tempat PKL
                                </a>
                                <a href="{{ route('guru.siswa.activity', $siswa->id) }}"
                                   class="btn btn-sm"
                                   style="border:1px solid #1d9a96; color:#1d9a96;">
                                    <i class="fas fa-tasks"></i> Daily Activity
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">Tidak ada data siswa</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

        </div>
    </div>
</div>


        </div>
    </div>
</div>

                </div>
                <!-- End Page Content -->
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('storage/assets/sbadmin2/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('storage/assets/sbadmin2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('storage/assets/sbadmin2/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('storage/assets/sbadmin2/js/sb-admin-2.min.js') }}"></script>
</body>
</html> --}}

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-primary navbar-dark sticky-top">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <!-- LOGIKA 1: Link Dashboard Dinamis -->
            @if (Auth::user()->role == 'admin')
                <a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard</a>
            @else
                <a href="{{ route('anggota.dashboard') }}" class="nav-link">Dashboard</a>
            @endif
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Cari data..."
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <!-- LOGIKA 2: Notifikasi Hanya Tampil Khusus Admin -->
        @if (Auth::user()->role == 'admin')
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    @if (isset($totalNotifikasi) && $totalNotifikasi > 0)
                        <span class="badge badge-warning navbar-badge">{{ $totalNotifikasi }}</span>
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">{{ $totalNotifikasi ?? 0 }} Notifikasi Baru</span>
                    <div class="dropdown-divider"></div>

                    @if (isset($peminjamanBaru) && $peminjamanBaru > 0)
                        <a href="{{ route('admin.peminjaman.index') }}" class="dropdown-item">
                            <i class="fas fa-book text-info mr-2"></i> {{ $peminjamanBaru }} Peminjaman Baru
                            <span class="float-right text-muted text-sm">Baru</span>
                        </a>
                        <div class="dropdown-divider"></div>
                    @endif

                    @if (isset($bukuTerlambat) && $bukuTerlambat > 0)
                        <a href="{{ route('admin.peminjaman.index') }}" class="dropdown-item">
                            <i class="fas fa-exclamation-circle text-danger mr-2"></i> {{ $bukuTerlambat }} Buku
                            Terlambat
                            <span class="float-right text-muted text-sm">Segera</span>
                        </a>
                        <div class="dropdown-divider"></div>
                    @endif

                    @if (!isset($totalNotifikasi) || $totalNotifikasi == 0)
                        <a href="#" class="dropdown-item text-center text-muted">
                            <small>Tidak ada notifikasi saat ini</small>
                        </a>
                        <div class="dropdown-divider"></div>
                    @endif

                    <a href="#" class="dropdown-item dropdown-footer">Lihat Semua Notifikasi</a>
                </div>
            </li>
        @endif

        <!-- User Profile Dropdown Menu -->
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" data-toggle="dropdown">
                @if (Auth::user()->foto)
                    <img src="{{ asset('storage/' . Auth::user()->foto) }}" class="user-image img-circle elevation-2"
                        alt="User Image" style="object-fit: cover;">
                @else
                    <!-- Default Avatar Inisial Nama (Navbar Ringkas) -->
                    <div class="rounded-circle mr-2 d-inline-flex align-items-center justify-content-center bg-light text-dark font-weight-bold shadow-sm"
                        style="width: 31px; height: 31px; font-size: 0.9rem; border: 1px solid #dee2e6;">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                @endif
                <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- User header -->
                <li class="user-header bg-primary d-flex flex-column align-items-center justify-content-center">
                    @if (Auth::user()->foto)
                        <img src="{{ asset('storage/' . Auth::user()->foto) }}" class="img-circle elevation-2 mb-2"
                            alt="User Image" style="object-fit: cover;">
                    @else
                        <!-- Default Avatar Inisial Nama (Dropdown Header Besar) -->
                        <div class="rounded-circle d-flex align-items-center justify-content-center bg-white text-primary font-weight-bold mb-2 shadow-sm"
                            style="width: 80px; height: 80px; font-size: 2.2rem; border: 3px solid rgba(255,255,255,0.4);">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    @endif
                    <p class="m-0">
                        {{ Auth::user()->name }}
                        <small
                            class="d-block mt-1">{{ Auth::user()->role == 'admin' ? 'Admin Perpustakaan' : 'Anggota Perpustakaan' }}</small>
                    </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer d-flex justify-content-between align-items-center">
                    <a href="{{ route('profile.index') }}" class="btn btn-default btn-flat rounded">Profil Saya</a>

                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-flat rounded">
                            <i class="fas fa-sign-out-alt me-1"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </li>
</nav>
<!-- /.navbar -->

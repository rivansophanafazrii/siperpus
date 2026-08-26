<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link bg-primary d-flex align-items-center justify-content-center px-3"
        style="height: 57px; border-bottom: 1px solid rgba(255,255,255,0.1); text-decoration: none;">
        <!-- Logo Gambar -->
        <img src="{{ asset('images/logo.png') }}" alt="Logo SIPERPUS"
            style="max-height: 32px; width: auto; object-fit: contain; margin-right: 8px;">

        <!-- Logo Teks SIPERPUS -->
        <span class="brand-text font-weight-bold text-white"
            style="font-size: 1.15rem; letter-spacing: 0.5px; line-height: 1;">
            SIPERPUS.
        </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
            <div class="image">
                @if (Auth::user()->foto)
                    <img src="{{ asset('storage/' . Auth::user()->foto) }}" class="img-circle elevation-2"
                        alt="User Image" style="width: 2.1rem; height: 2.1rem; object-fit: cover;">
                @else
                    <!-- Default Avatar Inisial Nama (Sidebar) -->
                    <div class="rounded-circle d-flex align-items-center justify-content-center bg-light text-dark font-weight-bold shadow-sm"
                        style="width: 2.1rem; height: 2.1rem; font-size: 0.95rem; border: 1px solid #ced4da;">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                @endif
            </div>
            <div class="info">
                <a href="{{ route('profile.index') }}" class="d-block font-weight-bold">{{ Auth::user()->name }}</a>
                <small class="text-muted text-capitalize">
                    <i class="fas fa-circle text-success" style="font-size: 10px;"></i> {{ Auth::user()->role }}
                </small>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                <!-- ============================================== -->
                <!--               MENU UNTUK ADMIN                 -->
                <!-- ============================================== -->
                @if (Auth::user()->role == 'admin')
                    <li class="nav-header">LAYANAN UTAMA</li>
                    <li class="nav-item">
                        <a href="{{ url('admin/dashboard') }}"
                            class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard Admin</p>
                        </a>
                    </li>

                    <li
                        class="nav-item {{ request()->is('admin/buku*') || request()->is('admin/kategori*') || request()->is('admin/rak*') || request()->is('admin/anggota*') ? 'menu-open' : '' }}">
                        <a href="#"
                            class="nav-link {{ request()->is('admin/buku*') || request()->is('admin/kategori*') || request()->is('admin/rak*') || request()->is('admin/anggota*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-database"></i>
                            <p>Master Data <i class="fas fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.buku.index') }}"
                                    class="nav-link {{ request()->routeIs('admin.buku.*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Data Buku</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.kategori.index') }}"
                                    class="nav-link {{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kategori Buku</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.rak.index') }}"
                                    class="nav-link {{ request()->routeIs('admin.rak.*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Data Rak</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.anggota.index') }}"
                                    class="nav-link {{ request()->routeIs('admin.anggota.*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Data Anggota</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li
                        class="nav-item {{ request()->is('admin/peminjaman*') || request()->is('admin/pengembalian*') ? 'menu-open' : '' }}">
                        <a href="#"
                            class="nav-link {{ request()->is('admin/peminjaman*') || request()->is('admin/pengembalian*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-sync-alt"></i>
                            <p>Sirkulasi Buku <i class="fas fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.peminjaman.index') }}"
                                    class="nav-link {{ request()->routeIs('admin.peminjaman.*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Peminjaman Baru</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.pengembalian.index') }}"
                                    class="nav-link {{ request()->routeIs('admin.pengembalian.*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Pengembalian & Denda</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-header">INTERAKSI & PUBLIKASI</li>
                    <li class="nav-item">
                        <a href="{{ route('admin.berita.index') }}"
                            class="nav-link {{ request()->routeIs('admin.berita.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-newspaper"></i>
                            <p>Data Berita</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.buku-tamu.index') }}"
                            class="nav-link {{ request()->routeIs('admin.buku-tamu.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-newspaper"></i>
                            <p>Data Buku Tamu</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.survei-kebutuhan.index') }}"
                            class="nav-link {{ request()->routeIs('admin.survei-kebutuhan.*') ? 'active' : '' }}">
                            <i class="fas fa-clipboard-list nav-icon"></i>
                            <p>Survei Kebutuhan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.survei-kepuasan.index') }}"
                            class="nav-link {{ request()->routeIs('admin.survei-kepuasan.*') ? 'active' : '' }}">
                            <i class="fas fa-poll nav-icon"></i>
                            <p>Survei Kepuasan</p>
                        </a>
                    </li>

                    <li class="nav-header">LAPORAN & PENGATURAN</li>
                    <li class="nav-item">
                        <a href="{{ route('admin.laporan.index') }}"
                            class="nav-link {{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>Laporan Perpustakaan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.profil.index') }}"
                            class="nav-link {{ request()->routeIs('admin.profil.*') ? 'active' : '' }}">
                            <i class="fas fa-building nav-icon"></i>
                            <p>Profil Perpustakaan</p>
                        </a>
                    </li>

                    <!-- ============================================== -->
                    <!--              MENU UNTUK ANGGOTA                -->
                    <!-- ============================================== -->
                @elseif(Auth::user()->role == 'anggota')
                    <li class="nav-header">MENU UTAMA</li>
                    <li class="nav-item">
                        <a href="{{ route('anggota.dashboard') }}"
                            class="nav-link {{ request()->routeIs('anggota.dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard Anggota</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <!-- Nanti arahkan ke route OPAC/Pencarian -->
                        <a href="{{ url('/opac') }}" class="nav-link">
                            <i class="nav-icon fas fa-search"></i>
                            <p>Cari Buku (Katalog)</p>
                        </a>
                    </li>

                    <li class="nav-header">SIRKULASI SAYA</li>
                    <li class="nav-item">
                        <!-- Nanti arahkan ke route peminjaman aktif anggota -->
                        <a href="{{ route('anggota.peminjaman.index') }}"
                            class="nav-link {{ request()->routeIs('anggota.peminjaman.index') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-hand-holding"></i>
                            <p>Peminjaman Saya</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <!-- Nanti arahkan ke route riwayat sirkulasi anggota -->
                        <a href="{{ route('anggota.peminjaman.riwayat') }}"
                            class="nav-link {{ request()->routeIs('anggota.peminjaman.riwayat') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-history"></i>
                            <p>Riwayat Sirkulasi</p>
                        </a>
                    </li>

                    <li class="nav-header">INFORMASI & LAYANAN</li>
                    <li class="nav-item">
                        <!-- Nanti arahkan ke route berita frontend atau khusus -->
                        <a href="{{ url('/berita') }}" class="nav-link">
                            <i class="nav-icon fas fa-newspaper"></i>
                            <p>Berita</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <!-- Nanti arahkan ke form buku tamu -->
                        <a href="{{ url('/buku-tamu') }}" class="nav-link">
                            <i class="nav-icon fas fa-book-open"></i>
                            <p>Isi Buku Tamu</p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-poll"></i>
                            <p>
                                Isi Survei
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <!-- Arahkan ke link landing page survei kepuasan -->
                                <a href="{{ url('/survei-kepuasan') }}" class="nav-link" target="_blank">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Survei Kepuasan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <!-- Arahkan ke link landing page survei kebutuhan -->
                                <a href="{{ url('/survei-kebutuhan') }}" class="nav-link" target="_blank">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Survei Kebutuhan</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                <!-- ============================================== -->
                <!--        MENU UMUM (Tampil untuk Semua Role)     -->
                <!-- ============================================== -->
                <li class="nav-header">AKUN SAYA</li>
                <li class="nav-item">
                    <!-- Memperbaiki rute dari admin.profile.index menjadi profile.index agar bisa diakses kedua role -->
                    <a href="{{ route('profile.index') }}"
                        class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>Profil Saya</p>
                    </a>
                </li>
                <li class="nav-item mt-2">
                    <a href="{{ route('logout') }}" class="nav-link text-danger"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
    </div>
</aside>

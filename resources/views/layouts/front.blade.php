<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPERPUS - SMPN 2 Kadugede</title>

    {{-- favicon --}}
    <link rel="icon" type="image/png" href="/images/favicon.png">


    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --color-primary: #2563EB;
            --color-primary-dark: #1D4ED8;
            --color-accent: #38BDF8;
            --color-surface: #FFFFFF;
            --color-background: #F8FAFC;
            --color-text-main: #0F172A;
            --color-text-muted: #64748B;
            --radius-card: 28px;
            --radius-pill: 50px;
            --shadow-soft: 0 12px 35px -8px rgba(37, 99, 235, 0.08);
            --shadow-hover: 0 25px 50px -12px rgba(37, 99, 235, 0.18);
            --transition-smooth: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--color-background);
            color: var(--color-text-main);
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        /* Spasial Antar Seksi Dinamis */
        .section-padding {
            padding-top: 4rem;
            padding-bottom: 4rem;
        }

        @media (min-width: 992px) {
            .section-padding {
                padding-top: 6rem;
                padding-bottom: 6rem;
            }
        }

        /* Bilah Navigasi */
        .navbar-premium {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.6);
            padding: 1rem 0;
            transition: var(--transition-smooth);
        }

        .brand-logo {
            font-weight: 800;
            font-size: 1.4rem;
            color: var(--color-text-main);
            text-decoration: none;
            letter-spacing: -0.5px;
        }

        .brand-dot {
            color: var(--color-primary);
        }

        .nav-link {
            font-weight: 600;
            color: var(--color-text-muted);
            padding: 0.5rem 1.1rem !important;
            font-size: 0.9rem;
            transition: var(--transition-smooth);
            border-radius: var(--radius-pill);
        }

        .nav-link:hover,
        .nav-link.show {
            color: var(--color-primary);
            background-color: rgba(37, 99, 235, 0.04);
        }

        .dropdown-menu {
            border: 1px solid rgba(226, 232, 240, 0.8);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(37, 99, 235, 0.1);
            padding: 0.85rem;
            margin-top: 0.85rem;
            min-width: 210px;
        }

        .dropdown-item {
            font-weight: 600;
            font-size: 0.9rem;
            color: var(--color-text-muted);
            padding: 0.65rem 1rem;
            border-radius: 12px;
            transition: var(--transition-smooth);
        }

        .dropdown-item:hover {
            background-color: #EFF6FF;
            color: var(--color-primary);
            transform: translateX(6px);
        }

        /* Area Hero - Dinamis */
        .hero-container {
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.92), rgba(37, 99, 235, 0.85)), url('https://images.unsplash.com/photo-1521587760476-6c12a4b040da?auto=format&fit=crop&w=1920&q=80') center/cover no-repeat;
            padding-top: 5rem;
            padding-bottom: 5rem;
            color: white;
            border-radius: 0 0 32px 32px;
            margin-bottom: 2rem;
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.15);
        }

        @media (min-width: 992px) {
            .hero-container {
                padding-top: 8rem;
                padding-bottom: 8rem;
                border-radius: 0 0 48px 48px;
            }
        }

        .hero-title {
            font-weight: 800;
            font-size: clamp(2.5rem, 5vw, 3.8rem);
            line-height: 1.15;
            letter-spacing: -1.5px;
            margin-bottom: 1.5rem;
        }

        .search-module {
            background: var(--color-surface);
            padding: 0.6rem 0.6rem 0.6rem 2rem;
            border-radius: var(--radius-pill);
            box-shadow: 0 25px 50px rgba(37, 99, 235, 0.18);
            border: 1px solid rgba(226, 232, 240, 0.8);
            margin-top: 3.5rem;
            max-width: 780px;
        }

        .search-input {
            border: none;
            background: transparent;
            padding: 0.5rem;
            font-size: 1rem;
            box-shadow: none !important;
            font-weight: 500;
            color: var(--color-text-main);
        }

        /* Tombol & Komponen */
        .btn-modern-primary {
            background: linear-gradient(135deg, #2563EB, #1D4ED8);
            color: white;
            font-weight: 700;
            padding: 0.75rem 1.8rem;
            border-radius: var(--radius-pill);
            border: none;
            box-shadow: 0 10px 25px -5px rgba(37, 99, 235, 0.4);
            transition: var(--transition-smooth);
            font-size: 0.95rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-modern-primary:hover {
            background: linear-gradient(135deg, #1D4ED8, #1E40AF);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 15px 30px -5px rgba(37, 99, 235, 0.6);
        }

        .btn-modern-ghost {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(8px);
            color: white;
            font-weight: 700;
            padding: 0.75rem 1.8rem;
            border-radius: var(--radius-pill);
            border: 2px solid rgba(255, 255, 255, 0.3);
            transition: var(--transition-smooth);
            font-size: 0.95rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-modern-ghost:hover {
            background: white;
            color: var(--color-text-main);
            border-color: white;
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(255, 255, 255, 0.2);
        }

        .btn-modern-outline {
            background: transparent;
            color: var(--color-primary);
            font-weight: 700;
            padding: 0.85rem 2.75rem;
            border-radius: var(--radius-pill);
            border: 2px solid rgba(37, 99, 235, 0.3);
            transition: var(--transition-smooth);
            font-size: 0.95rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-modern-outline:hover {
            background-color: var(--color-primary);
            border-color: var(--color-primary);
            color: white;
            transform: translateY(-3px);
        }

        .btn-card-action {
            background-color: #EFF6FF;
            color: var(--color-primary);
            font-weight: 700;
            padding: 0.7rem 1.25rem;
            border-radius: 16px;
            border: none;
            transition: var(--transition-smooth);
            font-size: 0.9rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        /* Kartu dan Gambar */
        .modern-card {
            background-color: var(--color-surface);
            border: 1px solid rgba(226, 232, 240, 0.8);
            border-radius: var(--radius-card);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            height: 100%;
            transition: var(--transition-smooth);
            box-shadow: var(--shadow-soft);
            position: relative;
        }

        .modern-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-hover);
            border-color: rgba(37, 99, 235, 0.35);
        }

        .card-img-wrapper {
            overflow: hidden;
            position: relative;
            background-color: #F8FAFC;
            margin: 0.75rem 0.75rem 0 0.75rem;
            border-radius: calc(var(--radius-card) - 8px);
        }

        .modern-card-img {
            width: 100%;
            object-fit: cover;
            transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .modern-card:hover .modern-card-img {
            transform: scale(1.08);
        }

        .img-news {
            height: 200px;
        }

        .modern-card-body {
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .modern-card-title {
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 0.6rem;
            color: var(--color-text-main);
            line-height: 1.4;
            transition: color 0.2s;
        }

        .news-title-link {
            text-decoration: none;
            color: var(--color-text-main);
        }

        .news-title-link:hover {
            color: var(--color-primary);
        }

        .modern-card-text {
            color: var(--color-text-muted);
            font-size: 0.9rem;
            margin-bottom: 0;
            line-height: 1.6;
        }

        .card-badge {
            position: absolute;
            top: 1.25rem;
            right: 1.25rem;
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(10px);
            color: var(--color-primary);
            font-size: 0.75rem;
            font-weight: 700;
            padding: 0.4rem 1rem;
            border-radius: var(--radius-pill);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            z-index: 2;
        }

        .news-meta {
            font-size: 0.82rem;
            color: var(--color-text-muted);
            margin-bottom: 0.85rem;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            font-weight: 600;
        }

        /* Ikon Layanan - Dinamis */
        .feature-card {
            background: var(--color-surface);
            border: 1px solid rgba(226, 232, 240, 0.8);
            border-radius: var(--radius-card);
            padding: 2rem 1.5rem;
            transition: var(--transition-smooth);
            height: 100%;
            box-shadow: var(--shadow-soft);
            text-align: center;
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-hover);
            border-color: rgba(37, 99, 235, 0.35);
        }

        .service-icon-box {
            width: 55px;
            height: 55px;
            background: #EFF6FF;
            color: var(--color-primary);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            margin: 0 auto 1rem auto;
            transition: var(--transition-smooth);
        }

        @media (min-width: 992px) {
            .service-icon-box {
                width: 76px;
                height: 76px;
                border-radius: 24px;
                font-size: 1.75rem;
                margin-bottom: 1.5rem;
            }
        }

        .feature-card:hover .service-icon-box {
            background: var(--color-primary);
            color: white;
            transform: scale(1.1) rotate(6deg);
        }

        /* Tipografi & Lainnya */
        .stat-value {
            font-weight: 800;
            font-size: 2.5rem;
            letter-spacing: -1px;
            color: var(--color-text-main);
        }

        .stat-label {
            font-weight: 600;
            color: var(--color-text-muted);
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.82rem;
            margin-top: 0.5rem;
        }

        .section-label {
            color: var(--color-primary);
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            font-size: 0.8rem;
            margin-bottom: 0.5rem;
            display: block;
        }

        .section-title {
            font-size: clamp(1.8rem, 4vw, 2.25rem);
            font-weight: 800;
            letter-spacing: -0.5px;
            margin-bottom: 0.75rem;
            color: var(--color-text-main);
        }

        /* Footer */
        .footer-premium {
            background-color: var(--color-surface);
            padding: 5rem 0 2rem;
            border-top: 1px solid rgba(226, 232, 240, 0.8);
        }

        .footer-title {
            font-weight: 700;
            color: var(--color-text-main);
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
        }

        .footer-link {
            color: var(--color-text-muted);
            text-decoration: none;
            display: block;
            margin-bottom: 0.75rem;
            font-weight: 500;
            font-size: 0.88rem;
            transition: var(--transition-smooth);
        }

        .footer-link:hover {
            color: var(--color-primary);
            transform: translateX(4px);
        }

        .social-icon-link {
            display: inline-block;
            transition: transform 0.2s ease, color 0.2s ease;
        }

        .social-icon-link:hover {
            transform: translateY(-3px);
            color: var(--color-primary) !important;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Decorative Ambient Blobs */
        .hero-container {
            position: relative;
            overflow: hidden;
        }

        .hero-blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.45;
            z-index: 1;
            pointer-events: none;
            animation: floatBlob 10s ease-in-out infinite alternate;
        }

        .blob-1 {
            width: 320px;
            height: 320px;
            background: #38BDF8;
            top: -50px;
            left: -60px;
        }

        .blob-2 {
            width: 380px;
            height: 380px;
            background: #818CF8;
            bottom: -80px;
            right: -80px;
            animation-delay: -5s;
        }

        .blob-section {
            position: absolute;
            width: 250px;
            height: 250px;
            background: rgba(37, 99, 235, 0.08);
            border-radius: 50%;
            filter: blur(60px);
            pointer-events: none;
            z-index: 0;
        }

        /* Pola Grid Abstrak Overlay (Diperbaiki) */
        .bg-grid-pattern::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: radial-gradient(rgba(255, 255, 255, 0.18) 1px, transparent 1px);
            background-size: 26px 26px;
            z-index: 1;
            pointer-events: none;
        }

        /* Animasi Melayang */
        @keyframes floatBlob {
            0% {
                transform: translateY(0px) rotate(0deg) scale(1);
            }

            100% {
                transform: translateY(-25px) rotate(12deg) scale(1.08);
            }
        }

        @keyframes floatBadge {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-8px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .floating-element {
            animation: floatBadge 4s ease-in-out infinite;
        }

        /* Glassmorphism Chip Abstrak */
        .glass-chip {
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.25);
            color: #fff;
            padding: 0.4rem 1.2rem;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
    </style>
</head>

<body>
    <!-- Navigasi -->
    <nav class="navbar navbar-expand-lg navbar-premium sticky-top bg-white shadow-sm">
        <div class="container">
            <!-- Brand Logo (Gambar + Teks) -->
            <a class="brand-logo d-flex align-items-center text-decoration-none gap-2" href="{{ route('home') }}">
                <!-- Ubah path src sesuai lokasi file logo Anda -->
                <img src="{{ asset('images/logo.png') }}" alt="Logo siperpus"
                    style="height: 40px; object-fit: contain;">
                <span class="fw-bold text-dark fs-4">SIPERPUS<span class="brand-dot text-primary">.</span></span>
            </a>

            <!-- Tombol Toggler Mobile -->
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#navMenu">
                <i class="fa-solid fa-bars fs-4 text-dark"></i>
            </button>

            <div class="collapse navbar-collapse" id="navMenu">
                <!-- Nav Items (Ditambahkan text-nowrap agar teks tidak terlipat) -->
                <ul class="navbar-nav mx-auto align-items-center mt-3 mt-lg-0 gap-lg-2">
                    <li class="nav-item">
                        <a class="nav-link text-nowrap fw-semibold" href="{{ route('home') }}">HOME</a>
                    </li>

                    <!-- Dropdown Profil -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-nowrap fw-semibold" href="#" id="profilDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">PROFIL</a>
                        <ul class="dropdown-menu border-0 shadow-sm" aria-labelledby="profilDropdown">
                            <li><a class="dropdown-item" href="{{ route('profil.sejarah') }}">Sejarah</a></li>
                            <li><a class="dropdown-item" href="{{ route('profil.visi-misi') }}">Visi dan Misi</a></li>
                            <li><a class="dropdown-item" href="{{ route('profil.struktur-organisasi') }}">Struktur
                                    Organisasi</a></li>
                            <li><a class="dropdown-item" href="{{ route('profil.tata-tertib') }}">Tata Tertib</a></li>
                            <li><a class="dropdown-item" href="{{ route('profil.jam-layanan') }}">Jam Layanan</a></li>
                        </ul>
                    </li>

                    <!-- Dropdown Layanan -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-nowrap fw-semibold" href="#" id="layananDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">LAYANAN</a>
                        <ul class="dropdown-menu border-0 shadow-sm" aria-labelledby="layananDropdown">
                            <li><a class="dropdown-item" href="{{ route('layanan.sirkulasi') }}">Sirkulasi</a></li>
                            <li><a class="dropdown-item" href="{{ route('opac.index') }}">OPAC</a></li>
                            <li><a class="dropdown-item" href="{{ route('layanan.referensi') }}">Referensi</a></li>
                            <li><a class="dropdown-item" href="{{ route('layanan.literasi') }}">Literasi</a></li>
                            <li><a class="dropdown-item" href="{{ route('layanan.pojok-baca') }}">Pojok Baca</a></li>
                            <li><a class="dropdown-item" href="{{ route('layanan.baca-ditempat') }}">Baca di Tempat</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('layanan.digital') }}">Koleksi Digital</a></li>
                            <li><a class="dropdown-item" href="{{ route('layanan.info') }}">Informasi Layanan</a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-nowrap fw-semibold" href="{{ route('berita.index') }}">BERITA</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-nowrap fw-semibold" href="{{ route('opac.index') }}">OPAC</a>
                    </li>

                    <!-- BUKU TAMU (Menggunakan text-nowrap agar sejajar 1 baris) -->
                    <li class="nav-item">
                        <a class="nav-link text-nowrap fw-semibold" href="{{ url('/buku-tamu') }}">BUKU TAMU</a>
                    </li>

                    <!-- Dropdown Survei -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-nowrap fw-semibold" href="#" id="surveiDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">SURVEI</a>
                        <ul class="dropdown-menu border-0 shadow-sm" aria-labelledby="surveiDropdown">
                            <li><a class="dropdown-item" href="{{ url('/survei-kebutuhan') }}">Survei Kebutuhan</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ url('/survei-kepuasan') }}">Survei Kepuasan</a></li>
                        </ul>
                    </li>
                </ul>

                <!-- Area Tombol Login / Dashboard -->
                <div class="d-flex align-items-center mt-3 mt-lg-0 ms-lg-2">
                    @auth
                        @if (auth()->user()->role == 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-primary text-nowrap shadow-sm px-4"
                                style="border-radius: 50px; font-weight: 700;">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('anggota.dashboard') }}" class="btn btn-primary text-nowrap shadow-sm px-4"
                                style="border-radius: 50px; font-weight: 700;">
                                Dashboard
                            </a>
                        @endif
                    @else
                        <a class="btn btn-primary text-nowrap shadow-sm px-4 rounded-pill fw-bold"
                            href="{{ route('login') }}">
                            <i class="fa-solid fa-arrow-right-to-bracket me-1"></i> Login
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- AREA KONTEN DINAMIS -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer id="profil" class="footer-premium">
        <div class="container">
            <div class="row g-4">
                <div class="col-12 col-lg-4 pe-lg-4 text-md-start">
                    <!-- Area Logo Footer -->
                    <div class="d-flex align-items-center justify-content-md-start gap-2 mb-3">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo siperpus"
                            style="height: 40px; object-fit: contain;">
                        <span class="fw-bold text-dark fs-4">SIPERPUS<span class="text-primary">.</span></span>
                    </div>

                    <p class="text-muted mb-4 lh-lg text-md-start" style="font-size: 0.9rem;">
                        {{ $profil->deskripsi_hero ?? 'Infrastruktur digital untuk mengoptimalkan manajemen sirkulasi akademik dan memfasilitasi penelusuran referensi literatur komprehensif.' }}
                    </p>

                    <div class="d-flex align-items-center justify-content-md-start gap-3">
                        <a href="#" class="text-muted text-decoration-none social-icon-link"
                            aria-label="Instagram"><i class="fab fa-instagram fa-lg"></i></a>
                        <a href="#" class="text-muted text-decoration-none social-icon-link"
                            aria-label="Facebook"><i class="fab fa-facebook fa-lg"></i></a>
                        <a href="#" class="text-muted text-decoration-none social-icon-link"
                            aria-label="YouTube"><i class="fab fa-youtube fa-lg"></i></a>
                    </div>
                </div>

                <div class="col-6 col-md-4 col-lg-2">
                    <h6 class="footer-title">LINK</h6>
                    <a href="{{ route('home') }}" class="footer-link">Home</a>
                    <a href="{{ route('opac.index') }}" class="footer-link">OPAC</a>
                    <a href="{{ route('berita.index') }}" class="footer-link">Berita</a>
                    <a href="{{ url('/survei-kebutuhan') }}" class="footer-link">Survei Kebutuhan</a>
                    <a href="{{ url('/survei-kepuasan') }}" class="footer-link">Survei Kepuasan</a>
                </div>

                <div class="col-6 col-md-4 col-lg-3">
                    <h6 class="footer-title">OPERASIONAL</h6>
                    <div class="mb-3">
                        <span class="text-muted fw-bold d-block mb-1" style="font-size: 0.80rem;">Senin - Jumat</span>
                        <span class="text-dark fw-bold">{{ $profil->jam_kerja_buka ?? '07:00' }} -
                            {{ $profil->jam_kerja_tutup ?? '15:00' }}</span>
                    </div>
                    <div>
                        <span class="text-muted fw-bold d-block mb-1" style="font-size: 0.80rem;">Akhir Pekan</span>
                        <span class="text-danger fw-bold">Tutup / Libur</span>
                    </div>
                </div>

                <div class="col-12 col-md-4 col-lg-3 text-md-start">
                    <h6 class="footer-title">KONTAK RESMI</h6>
                    <p class="text-muted mb-2" style="font-size: 0.9rem;"><i
                            class="fa-solid fa-location-dot me-2 text-primary"></i> {{ $profil->alamat ?? '-' }}</p>
                    <p class="text-muted mb-2" style="font-size: 0.9rem;"><i
                            class="fa-solid fa-envelope me-2 text-primary"></i> {{ $profil->email ?? '-' }}</p>
                    <p class="text-muted mb-0" style="font-size: 0.9rem;"><i
                            class="fa-solid fa-phone me-2 text-primary"></i> {{ $profil->telepon ?? '-' }}</p>
                </div>
            </div>

            <div class="mt-5 pt-4 border-top text-center">
                <p class="text-muted mb-0" style="font-size: 0.85rem;">Copyright &copy; 2026 SMPN 2 Kadugede. All
                    rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

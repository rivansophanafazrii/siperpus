@extends('layouts.front')

@section('content')
    <style>
        /* Penyesuaian Halaman Statis Selaras dengan Landing Page */
        .service-hero-container {
            /* Mengambil gradien biru/ungu dan gambar latar dari landing page */
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.92), rgba(37, 99, 235, 0.85)), url('https://images.unsplash.com/photo-1521587760476-6c12a4b040da?auto=format&fit=crop&w=1920&q=80') center/cover no-repeat;
            padding: 8rem 0 7rem 0;
            border-radius: 0 0 48px 48px;
            /* Lengkungan melingkar di bawah */
            margin-bottom: 2rem;
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.15);
        }

        /* Teks diubah menjadi putih agar terbaca jelas di latar gelap */
        .service-title {
            color: #ffffff;
            font-weight: 800;
            letter-spacing: -0.75px;
        }

        .service-subtitle {
            color: rgba(255, 255, 255, 0.85);
            font-size: 1.1rem;
            max-width: 650px;
            line-height: 1.7;
        }

        /* Kotak ikon disesuaikan bergaya kaca transparan (glassmorphism) */
        .service-icon-box-hero {
            width: 85px;
            height: 85px;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            color: #ffffff;
            border-radius: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.2rem;
            margin: 0 auto 1.5rem auto;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Gaya untuk box konten putih di bawah hero */
        .content-box {
            background-color: var(--color-surface);
            border: 1px solid rgba(226, 232, 240, 0.8);
            box-shadow: var(--shadow-soft);
            border-radius: var(--radius-card);
        }

        .service-content {
            line-height: 1.8;
            font-size: 1.05rem;
            color: var(--color-text-main);
        }

        .service-content ul {
            list-style-type: disc;
            padding-left: 1.5rem;
            color: var(--color-text-muted);
        }

        .service-content ul li {
            margin-bottom: 0.8rem;
        }
    </style>

    <!-- Pahlawan Visual (Hero Section) -->
    <section class="service-hero-container bg-grid-pattern">
        <div class="container text-center">
            <!-- Ikon Layanan -->
            <div class="service-icon-box-hero shadow-sm mb-4 floating-element">
                <i class="fa-solid fa-right-left"></i>
            </div>

            <!-- Judul & Deskripsi -->
            <h1 class="display-5 service-title mb-3">Layanan Sirkulasi</h1>
            <p class="service-subtitle mx-auto">
                Informasi lengkap mengenai peminjaman, pengembalian, dan perpanjangan koleksi perpustakaan.
            </p>
        </div>
    </section>

    <!-- Konten Utama -->
    <div class="container pb-5" style="margin-top: -65px; position: relative; z-index: 10;">
        <div class="row justify-content-center">
            <div class="col-lg-9 content-box p-4 p-md-5 rounded-4">

                <div class="service-content">
                    <h4 class="font-weight-bold mb-3 text-dark">Apa itu Layanan Sirkulasi?</h4>
                    <p>Layanan sirkulasi adalah ujung tombak pelayanan perpustakaan yang melayani pengguna dalam hal
                        peminjaman dan pengembalian bahan pustaka (buku). Melalui layanan ini, anggota perpustakaan dapat
                        memanfaatkan koleksi untuk dibawa pulang sesuai dengan peraturan yang berlaku.</p>

                    <hr class="my-4">

                    <h5 class="font-weight-bold mb-3 text-dark"><i
                            class="fas fa-clipboard-list mr-2 text-primary"></i>Ketentuan Peminjaman</h5>
                    <ul class="mb-4">
                        <li class="mb-2">Peminjam harus terdaftar sebagai anggota aktif perpustakaan.</li>
                        <li class="mb-2">Maksimal buku yang dapat dipinjam adalah <strong>3 (tiga) eksemplar</strong>.
                        </li>
                        <li class="mb-2">Jangka waktu peminjaman adalah <strong>7 (tujuh) hari</strong>.</li>
                        <li class="mb-2">Peminjam wajib menunjukkan Kartu Anggota yang sah.</li>
                    </ul>

                    <h5 class="font-weight-bold mb-3 text-dark"><i
                            class="fas fa-exclamation-triangle mr-2 text-warning"></i>Keterlambatan dan Sanksi</h5>
                    <p>Untuk menjaga kedisiplinan dan keadilan bagi anggota lain, perpustakaan menerapkan aturan denda
                        keterlambatan:</p>
                    <ul>
                        <li class="mb-2">Denda keterlambatan sebesar <strong>Rp 500,- / buku / hari</strong>.</li>
                        <li class="mb-2">Buku yang hilang atau rusak wajib diganti dengan judul buku yang sama atau
                            membayar denda seharga buku tersebut.</li>
                    </ul>
                </div>

                <!-- Tombol Navigasi Bawah -->
                <div class="d-flex justify-content-between align-items-center mt-5 pt-4 border-top">
                    <a href="{{ url('/') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali
                    </a>
                    <!-- Link ke OPAC -->
                    <a href="{{ route('opac.index') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
                        Cari Buku Sekarang <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>
@endsection

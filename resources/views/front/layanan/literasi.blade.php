@extends('layouts.front')

@section('content')
    <style>
        /* Penyesuaian Halaman Statis Selaras dengan Landing Page */
        .service-hero-container {
            /* Gradien biru/ungu dan gambar latar dari landing page */
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.92), rgba(37, 99, 235, 0.85)), url('https://images.unsplash.com/photo-1521587760476-6c12a4b040da?auto=format&fit=crop&w=1920&q=80') center/cover no-repeat;
            padding: 8rem 0 7rem 0;
            border-radius: 0 0 48px 48px;
            margin-bottom: 2rem;
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.15);
        }

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
            background-color: var(--color-surface, #ffffff);
            border: 1px solid rgba(226, 232, 240, 0.8);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            border-radius: var(--radius-card, 28px);
        }

        .service-content {
            line-height: 1.8;
            font-size: 1.05rem;
            color: var(--color-text-main, #334155);
        }

        .service-content ul {
            list-style-type: disc;
            padding-left: 1.5rem;
            color: var(--color-text-muted, #64748b);
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
                <i class="fa-solid fa-pen-nib"></i>
            </div>

            <!-- Judul & Deskripsi -->
            <h1 class="display-5 service-title mb-3">Layanan Literasi</h1>
            <p class="service-subtitle mx-auto">
                Program peningkatan minat baca, bimbingan literasi informasi, dan kegiatan edukatif perpustakaan.
            </p>
        </div>
    </section>

    <!-- Konten Utama (Melayang di atas Hero) -->
    <div class="container pb-5" style="margin-top: -65px; position: relative; z-index: 10;">
        <div class="row justify-content-center">
            <div class="col-lg-9 content-box p-4 p-md-5">

                <div class="service-content">
                    <h4 class="fw-bold mb-3" style="color: var(--color-text-main, #0f172a);">Apa itu Program Literasi?</h4>
                    <p style="color: var(--color-text-muted, #64748b);">Layanan literasi perpustakaan bukan sekadar meminjam
                        buku, melainkan wadah untuk mengembangkan kemampuan membaca, memahami, mengevaluasi, dan menciptakan
                        karya. Kami berkomitmen untuk menjadikan perpustakaan sebagai pusat peradaban dan pusat kegiatan
                        belajar yang menyenangkan bagi seluruh warga sekolah.</p>

                    <hr class="my-4" style="border-color: rgba(226, 232, 240, 0.8);">

                    <h5 class="fw-bold mb-3" style="color: var(--color-text-main, #0f172a);">
                        <i class="fa-solid fa-list-check me-2" style="color: var(--color-primary, #2563eb);"></i> Bentuk
                        Kegiatan
                    </h5>
                    <p style="color: var(--color-text-muted, #64748b);">Beberapa program unggulan literasi yang rutin
                        dilaksanakan oleh perpustakaan antara lain:</p>
                    <ul class="mb-4">
                        <li><strong style="color: var(--color-text-main, #0f172a);">Bimbingan Pemustaka:</strong> Pengenalan
                            fasilitas, tata tertib, dan cara penelusuran informasi yang efektif bagi anggota baru.</li>
                        <li><strong style="color: var(--color-text-main, #0f172a);">Pojok Baca & Mading Literasi:</strong>
                            Memfasilitasi siswa untuk mempublikasikan karya tulis (puisi, cerpen, resensi) hasil bacaan
                            mereka.</li>
                        <li><strong style="color: var(--color-text-main, #0f172a);">Gerakan Literasi Sekolah (GLS):</strong>
                            Membaca senyap 15 menit sebelum kegiatan belajar mengajar dimulai.</li>
                        <li><strong style="color: var(--color-text-main, #0f172a);">Pembuatan Resensi/Sinopsis:</strong>
                            Program apresiasi bagi anggota yang aktif membaca dan memberikan ulasan buku terbanyak.</li>
                    </ul>

                    <h5 class="fw-bold mb-3" style="color: var(--color-text-main, #0f172a);">
                        <i class="fa-solid fa-users me-2" style="color: var(--color-primary, #2563eb);"></i> Mari Bergabung!
                    </h5>
                    <p style="color: var(--color-text-muted, #64748b);">Seluruh anggota perpustakaan dapat berpartisipasi
                        aktif dalam kegiatan literasi. Jadikan perpustakaan sebagai tempat favoritmu untuk bertukar ide,
                        berdiskusi, dan mengembangkan potensi diri melalui buku.</p>
                </div>

                <!-- Tombol Navigasi Bawah -->
                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-5 pt-4 border-top gap-3"
                    style="border-color: rgba(226, 232, 240, 0.8) !important;">
                    <a href="{{ url('/') }}" class="btn btn-outline-secondary rounded-pill fw-bold"
                        style="padding: 0.6rem 1.5rem;">
                        <i class="fa-solid fa-arrow-left"></i> Kembali Ke Beranda
                    </a>

                    <a href="{{ route('berita.index') }}" class="btn btn-primary rounded-pill fw-bold shadow-sm"
                        style="padding: 0.6rem 1.5rem;">
                        Lihat Berita Kegiatan <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>
@endsection

@extends('layouts.front')

@section('content')
    <style>
        /* Penyesuaian Halaman Statis Selaras dengan Landing Page */
        .service-hero-container {
            /* Gradien biru/ungu dan gambar latar dari landing page */
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.92), rgba(37, 99, 235, 0.85)), url('https://images.unsplash.com/photo-1521587760476-6c12a4b040da?auto=format&fit=crop&w=1920&q=80') center/cover no-repeat;
            padding: 8rem 0 7rem 0;
            border-radius: 0 0 48px 48px;
            /* Lengkungan melingkar di bawah */
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
            /* Soft shadow jika variabel global tidak terbaca */
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
                <i class="fa-solid fa-book-open-reader"></i>
            </div>

            <!-- Judul & Deskripsi -->
            <h1 class="display-5 service-title mb-3">Layanan Referensi</h1>
            <p class="service-subtitle mx-auto">
                Bantuan penelusuran informasi, panduan literatur ilmiah, dan konsultasi kebutuhan riset Anda.
            </p>
        </div>
    </section>

    <!-- Konten Utama (Melayang di atas Hero) -->
    <div class="container pb-5" style="margin-top: -65px; position: relative; z-index: 10;">
        <div class="row justify-content-center">
            <div class="col-lg-9 content-box p-4 p-md-5">

                <div class="service-content">
                    <h4 class="fw-bold mb-3" style="color: var(--color-text-main, #0f172a);">Apa itu Layanan Referensi?</h4>
                    <p style="color: var(--color-text-muted, #64748b);">Layanan referensi adalah pemberian bantuan kepada
                        anggota perpustakaan untuk menemukan informasi yang spesifik dan mendalam. Melalui layanan ini,
                        pustakawan kami siap membimbing Anda dalam menelusuri koleksi rujukan seperti ensiklopedia, kamus,
                        direktori, atlas, jurnal, dan literatur lainnya yang mendukung tugas atau penelitian.</p>

                    <hr class="my-4" style="border-color: rgba(226, 232, 240, 0.8);">

                    <h5 class="fw-bold mb-3" style="color: var(--color-text-main, #0f172a);">
                        <i class="fa-solid fa-circle-info me-2" style="color: var(--color-primary, #2563eb);"></i> Ketentuan
                        Layanan
                    </h5>
                    <ul class="mb-4">
                        <li>Koleksi Referensi <strong style="color: var(--color-text-main, #0f172a);">tidak dipinjamkan
                                untuk dibawa pulang</strong> (hanya untuk dibaca di ruang perpustakaan).</li>
                        <li>Pemustaka diperkenankan untuk menyalin atau memfotokopi sebagian isi dari bahan referensi dengan
                            izin petugas, sesuai dengan ketentuan Undang-Undang Hak Cipta.</li>
                        <li>Pemustaka wajib menjaga keutuhan dan kebersihan bahan pustaka yang dibaca.</li>
                    </ul>

                    <h5 class="fw-bold mb-3" style="color: var(--color-text-main, #0f172a);">
                        <i class="fa-solid fa-magnifying-glass me-2" style="color: var(--color-primary, #2563eb);"></i>
                        Bantuan Penelusuran
                    </h5>
                    <p style="color: var(--color-text-muted, #64748b);">Jika Anda kesulitan menemukan informasi atau data
                        tertentu, jangan ragu untuk menghubungi staf perpustakaan. Kami melayani:</p>
                    <ul>
                        <li>Bimbingan penggunaan Katalog Online (OPAC).</li>
                        <li>Strategi penelusuran informasi di internet maupun database jurnal jurnal langganan/akses
                            terbuka.</li>
                        <li>Bantuan pengecekan ketersediaan bahan pustaka dari judul yang direkomendasikan pengajar.</li>
                    </ul>
                </div>

                <!-- Tombol Navigasi Bawah -->
                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-5 pt-4 border-top gap-3"
                    style="border-color: rgba(226, 232, 240, 0.8) !important;">
                    <a href="{{ url('/') }}" class="btn btn-outline-secondary rounded-pill fw-bold"
                        style="padding: 0.6rem 1.5rem;">
                        <i class="fa-solid fa-arrow-left"></i> Kembali Ke Beranda
                    </a>

                    <a href="{{ route('opac.index') }}" class="btn btn-primary rounded-pill fw-bold shadow-sm"
                        style="padding: 0.6rem 1.5rem;">
                        Cari Referensi Sekarang <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>
@endsection

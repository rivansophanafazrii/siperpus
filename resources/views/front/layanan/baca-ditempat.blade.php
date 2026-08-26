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
        box-shadow: 0 10px 30px rgba(0,0,0,0.05); 
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
            <i class="fa-solid fa-book-reader"></i>
        </div>

        <!-- Judul & Deskripsi -->
        <h1 class="display-5 service-title mb-3">Layanan Baca di Tempat</h1>
        <p class="service-subtitle mx-auto">
            Fasilitas ruang baca yang nyaman, tenang, dan kondusif untuk mendukung kegiatan belajar serta literasi Anda.
        </p>
    </div>
</section>

<!-- Konten Utama (Melayang di atas Hero) -->
<div class="container pb-5" style="margin-top: -65px; position: relative; z-index: 10;">
    <div class="row justify-content-center">
        <div class="col-lg-9 content-box p-4 p-md-5">

            <div class="service-content">
                <h4 class="fw-bold mb-3" style="color: var(--color-text-main, #0f172a);">Tentang Layanan Ini</h4>
                <p style="color: var(--color-text-muted, #64748b);">Layanan Baca di Tempat diperuntukkan bagi seluruh pemustaka yang ingin memanfaatkan waktu luangnya untuk membaca koleksi perpustakaan langsung di area yang telah kami sediakan. Ruang baca kami didesain sedemikian rupa agar menciptakan suasana yang tenang, sehingga Anda dapat lebih fokus saat belajar, mengerjakan tugas, atau sekadar menikmati bahan bacaan.</p>

                <hr class="my-4" style="border-color: rgba(226, 232, 240, 0.8);">

                <h5 class="fw-bold mb-3" style="color: var(--color-text-main, #0f172a);">
                    <i class="fa-solid fa-building-circle-check me-2" style="color: var(--color-primary, #2563eb);"></i> Fasilitas Ruang Baca
                </h5>
                <p style="color: var(--color-text-muted, #64748b);">Untuk menunjang kenyamanan pengunjung, area baca di tempat telah dilengkapi dengan:</p>
                <ul class="mb-4">
                    <li><strong style="color: var(--color-text-main, #0f172a);">Meja & Kursi Baca:</strong> Penataan tempat duduk yang ergonomis dan cukup untuk perorangan maupun kelompok kecil.</li>
                    <li><strong style="color: var(--color-text-main, #0f172a);">Koneksi Wi-Fi:</strong> Akses internet gratis bagi anggota untuk keperluan penelusuran informasi digital.</li>
                    <li><strong style="color: var(--color-text-main, #0f172a);">Sirkulasi Udara & Pencahayaan:</strong> Ruangan ber-AC/sejuk dengan pencahayaan yang standar untuk menjaga kesehatan mata saat membaca.</li>
                    <li><strong style="color: var(--color-text-main, #0f172a);">Stopkontak:</strong> Tersedia di beberapa titik untuk mendukung pemustaka yang membawa laptop atau gawai pembelajaran.</li>
                </ul>

                <h5 class="fw-bold mb-3" style="color: var(--color-text-main, #0f172a);">
                    <i class="fa-solid fa-clipboard-list me-2" style="color: var(--color-primary, #2563eb);"></i> Tata Tertib Ruang Baca
                </h5>
                <p style="color: var(--color-text-muted, #64748b);">Demi kenyamanan bersama, mohon perhatikan hal-hal berikut saat berada di ruang baca perpustakaan:</p>
                <ul>
                    <li>Harap <strong style="color: var(--color-text-main, #0f172a);">menjaga ketenangan</strong> dengan tidak mengobrol berlebihan atau membuat keributan. Nonaktifkan atau gunakan mode getar pada telepon seluler.</li>
                    <li>Dilarang membawa makanan dan minuman ke dalam area ruang baca untuk menghindari kerusakan pada koleksi buku (kecuali air mineral dalam botol tertutup jika diizinkan petugas).</li>
                    <li><strong style="color: var(--color-text-main, #0f172a);">Tinggalkan buku di meja/troli.</strong> Buku yang telah selesai dibaca tidak perlu dikembalikan sendiri ke rak. Letakkan di tempat yang disediakan (troli pengembalian) agar petugas kami yang merapikannya, guna menghindari salah letak buku.</li>
                    <li>Dilarang melipat halaman, mencoret-coret, atau merobek bagian dari buku/koleksi perpustakaan.</li>
                </ul>
            </div>

            <!-- Tombol Navigasi Bawah -->
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-5 pt-4 border-top gap-3" style="border-color: rgba(226, 232, 240, 0.8) !important;">
                <a href="{{ url('/') }}" class="btn btn-outline-secondary rounded-pill fw-bold" style="padding: 0.6rem 1.5rem;">
                    <i class="fa-solid fa-arrow-left"></i> Kembali Ke Beranda
                </a>
                
                <a href="{{ route('opac.index') }}" class="btn btn-primary rounded-pill fw-bold shadow-sm" style="padding: 0.6rem 1.5rem;">
                    Lihat Katalog Buku <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

        </div>
    </div>
</div>
@endsection
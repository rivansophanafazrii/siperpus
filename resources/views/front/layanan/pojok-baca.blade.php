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
        <!-- Ikon Layanan (Sofa/Tempat Baca Santai) -->
        <div class="service-icon-box-hero shadow-sm mb-4 floating-element">
            <i class="fa-solid fa-couch"></i>
        </div>

        <!-- Judul & Deskripsi -->
        <h1 class="display-5 service-title mb-3">Pojok Baca</h1>
        <p class="service-subtitle mx-auto">
            Area baca yang santai, nyaman, dan inspiratif untuk mendekatkan buku dengan keseharian Anda.
        </p>
    </div>
</section>

<!-- Konten Utama (Melayang di atas Hero) -->
<div class="container pb-5" style="margin-top: -65px; position: relative; z-index: 10;">
    <div class="row justify-content-center">
        <div class="col-lg-9 content-box p-4 p-md-5">

            <div class="service-content">
                <h4 class="fw-bold mb-3" style="color: var(--color-text-main, #0f172a);">Tentang Pojok Baca</h4>
                <p style="color: var(--color-text-muted, #64748b);">Pojok Baca adalah inovasi ekstensi layanan dari perpustakaan utama yang ditempatkan pada area strategis (seperti sudut ruang kelas, lobi, atau taman). Kami menghadirkan suasana yang santai tanpa meja dan kursi formal, melainkan dengan karpet, bantal, atau sofa, untuk merangsang kebiasaan membaca di waktu luang.</p>

                <hr class="my-4" style="border-color: rgba(226, 232, 240, 0.8);">

                <h5 class="fw-bold mb-3" style="color: var(--color-text-main, #0f172a);">
                    <i class="fa-solid fa-layer-group me-2" style="color: var(--color-primary, #2563eb);"></i> Fasilitas & Koleksi
                </h5>
                <p style="color: var(--color-text-muted, #64748b);">Koleksi yang kami sediakan di Pojok Baca difokuskan pada bacaan ringan dan menghibur untuk memecah kejenuhan, di antaranya:</p>
                <ul class="mb-4">
                    <li><strong style="color: var(--color-text-main, #0f172a);">Fiksi & Sastra:</strong> Novel remaja, cerita pendek, puisi, dan komik edukasi.</li>
                    <li><strong style="color: var(--color-text-main, #0f172a);">Terbitan Berkala:</strong> Majalah populer, buletin sekolah, dan koran terbaru.</li>
                    <li><strong style="color: var(--color-text-main, #0f172a);">Buku Populer:</strong> Motivasi, biografi tokoh, ensiklopedia mini, dan buku keterampilan/hobi.</li>
                </ul>

                <h5 class="fw-bold mb-3" style="color: var(--color-text-main, #0f172a);">
                    <i class="fa-solid fa-hand-holding-heart me-2" style="color: var(--color-primary, #2563eb);"></i> Etika Penggunaan
                </h5>
                <ul>
                    <li>Buku pada Pojok Baca <strong style="color: var(--color-text-main, #0f172a);">diutamakan untuk dibaca di tempat</strong> dan tidak untuk dipinjamkan ke rumah tanpa prosedur dari perpustakaan.</li>
                    <li>Kembalikan buku dan bahan bacaan dengan rapi ke rak atau keranjang yang telah disediakan setelah selesai dibaca.</li>
                    <li>Jaga kebersihan area Pojok Baca dengan tidak makan atau minum sembarangan yang dapat merusak koleksi buku maupun fasilitas (karpet/sofa).</li>
                    <li>Jaga ketenangan agar tidak mengganggu teman-teman lain yang sedang fokus membaca.</li>
                </ul>
            </div>

            <!-- Tombol Navigasi Bawah -->
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-5 pt-4 border-top gap-3" style="border-color: rgba(226, 232, 240, 0.8) !important;">
                <a href="{{ url('/') }}" class="btn btn-outline-secondary rounded-pill fw-bold" style="padding: 0.6rem 1.5rem;">
                    <i class="fa-solid fa-arrow-left"></i> Kembali Ke Beranda
                </a>
                
                <a href="{{ route('opac.index') }}" class="btn btn-primary rounded-pill fw-bold shadow-sm" style="padding: 0.6rem 1.5rem;">
                    Cari Buku di OPAC <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

        </div>
    </div>
</div>
@endsection
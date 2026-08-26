@extends('layouts.front')

@section('content')
    <style>
        /* Penyesuaian Halaman Statis Selaras dengan Landing Page */
        .page-hero-container {
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.92), rgba(37, 99, 235, 0.85)), url('https://images.unsplash.com/photo-1521587760476-6c12a4b040da?auto=format&fit=crop&w=1920&q=80') center/cover no-repeat;
            padding: 8rem 0 7rem 0;
            border-radius: 0 0 48px 48px;
            margin-bottom: 2rem;
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.15);
        }

        .page-title {
            color: #ffffff;
            font-weight: 800;
            letter-spacing: -0.75px;
        }

        .page-subtitle {
            color: rgba(255, 255, 255, 0.85);
            font-size: 1.1rem;
            max-width: 650px;
            line-height: 1.7;
        }

        .page-icon-box-hero {
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

        /* Efek hover kartu berita */
        .hover-elevate {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .hover-elevate:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(37, 99, 235, 0.15) !important;
        }

        .content-box {
            background-color: var(--color-surface, #ffffff);
            border-radius: var(--radius-card, 28px);
        }

        /* Label Kategori Clickable */
        .badge-category {
            position: relative;
            z-index: 2; /* Penting agar tidak tertutup stretched-link */
            transition: all 0.2s ease;
        }
        
        .badge-category:hover {
            background-color: var(--color-primary) !important;
            color: #ffffff !important;
            transform: scale(1.05);
        }

        /* Rasio Gambar Konsisten */
        .news-img-cover {
            width: 100%;
            aspect-ratio: 16/9;
            object-fit: cover;
        }
    </style>

    <!-- Pahlawan Visual (Hero Section) -->
    <section class="page-hero-container bg-grid-pattern">
        <div class="container text-center">
            <div class="page-icon-box-hero shadow-sm mb-4 floating-element">
                <i class="fa-regular fa-newspaper"></i>
            </div>
            <h1 class="display-5 page-title mb-3">Kabar & Berita Perpustakaan</h1>
            <p class="page-subtitle mx-auto">
                Informasi terbaru seputar kegiatan, koleksi buku baru, dan layanan kami.
            </p>
        </div>
    </section>

    <!-- Konten Utama -->
    <div class="container pb-5" style="margin-top: -50px; position: relative; z-index: 10;">

        <!-- Filter Kategori -->
        <div class="d-flex justify-content-center flex-wrap gap-2 mb-5 content-box p-3 shadow-sm mx-auto"
            style="max-width: 800px; border: 1px solid rgba(226, 232, 240, 0.8);">
            <a href="{{ route('berita.index') }}"
                class="btn {{ request()->routeIs('berita.index') ? 'btn-primary' : 'btn-outline-primary' }} rounded-pill px-4 fw-bold">
                Semua
            </a>

            @foreach ($semuaKategori as $kat)
                <a href="{{ route('berita.kategori', $kat) }}"
                    class="btn {{ isset($kategori) && $kategori == $kat ? 'btn-primary' : 'btn-outline-primary' }} rounded-pill px-4 fw-bold">
                    {{ $kat }}
                </a>
            @endforeach
        </div>

        <!-- Grid Berita -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 pt-3">
            @forelse($berita as $item)
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden hover-elevate content-box"
                        style="border: 1px solid rgba(226, 232, 240, 0.8) !important;">
                        
                        <!-- Gambar Cover Berita -->
                        @if ($item->gambar)
                            <img src="{{ asset('storage/' . $item->gambar) }}" class="card-img-top news-img-cover"
                                alt="{{ $item->judul }}">
                        @else
                            <div class="bg-light d-flex justify-content-center align-items-center news-img-cover">
                                <span class="text-muted"><i class="fas fa-image fa-2x"></i></span>
                            </div>
                        @endif

                        <div class="card-body p-4 d-flex flex-column">
                            <!-- Kategori Berita (Sekarang Bisa Diklik) -->
                            <div class="mb-3">
                                <a href="{{ route('berita.kategori', $item->kategori) }}" 
                                   class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill text-decoration-none badge-category">
                                    {{ $item->kategori }}
                                </a>
                            </div>

                            <!-- Judul (Stretched Link ke Detail) -->
                            <h5 class="card-title fw-bold mb-3" style="line-height: 1.4;">
                                <a href="{{ route('berita.detail', $item->slug) }}"
                                    class="text-dark text-decoration-none stretched-link">
                                    {{ $item->judul }}
                                </a>
                            </h5>

                            <!-- Cuplikan Konten -->
                            <p class="card-text text-muted small flex-grow-1" style="line-height: 1.6;">
                                {{ \Illuminate\Support\Str::limit(strip_tags($item->konten), 100) }}
                            </p>
                        </div>

                        <!-- Footer Card -->
                        <div class="card-footer bg-transparent border-0 px-4 pb-4 pt-0 d-flex justify-content-between align-items-center">
                            <small class="text-muted d-flex align-items-center gap-2">
                                <span><i class="far fa-user me-1"></i> {{ $item->user->name ?? 'Admin' }}</span>
                                <span>•</span>
                                <span><i class="far fa-calendar-alt me-1"></i> {{ $item->created_at->format('d M Y') }}</span>
                            </small>
                        </div>
                    </div>
                </div>
            @empty
                <!-- Tampilan Jika Berita Kosong -->
                <div class="col-12 text-center py-5">
                    <div class="p-5 bg-light rounded-4 shadow-sm" style="border: 1px solid rgba(226, 232, 240, 0.8);">
                        <div class="mb-3 text-muted">
                            <i class="fas fa-folder-open fa-3x"></i>
                        </div>
                        <h5 class="text-muted fw-bold mb-0">Belum ada berita yang dipublikasikan.</h5>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Link Pagination Bootstrap 5 -->
        <div class="d-flex justify-content-center mt-5">
            {{ $berita->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
@extends('layouts.front')

@section('content')
    <style>
        .badge-category {
            transition: all 0.2s ease;
        }
        .badge-category:hover {
            background-color: var(--color-primary) !important;
            color: #ffffff !important;
            transform: scale(1.05);
        }
        .sidebar-news-link:hover {
            color: var(--color-primary) !important;
        }
    </style>

    <div class="container py-5 mt-4">
        <!-- Breadcrumb Navigasi -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb bg-transparent p-0 m-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('berita.index') }}" class="text-decoration-none">Berita</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ \Illuminate\Support\Str::limit($berita->judul, 40) }}</li>
            </ol>
        </nav>

        <div class="row g-4">
            <!-- Kolom Utama: Isi Berita -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5">
                    
                    <!-- Meta Info (Kategori bisa di-klik) -->
                    <div class="d-flex flex-wrap align-items-center gap-3 mb-3">
                        <a href="{{ route('berita.kategori', $berita->kategori ?? 'Umum') }}" 
                           class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill text-decoration-none badge-category">
                            {{ $berita->kategori ?? 'Umum' }}
                        </a>
                        <small class="text-muted">
                            <i class="far fa-user me-1"></i> Oleh
                            <strong>{{ $berita->user->name ?? 'Admin' }}</strong>
                        </small>
                        <small class="text-muted">•</small>
                        <small class="text-muted">
                            <i class="far fa-calendar-alt me-1"></i> {{ $berita->created_at->format('d M Y') }}
                        </small>
                    </div>

                    <!-- Judul Berita -->
                    <h1 class="fw-bold text-dark mb-4" style="line-height: 1.3;">{{ $berita->judul }}</h1>

                    <!-- Gambar Cover Utama -->
                    @if ($berita->gambar)
                        <div class="mb-4 overflow-hidden rounded-4">
                            <img src="{{ asset('storage/' . $berita->gambar) }}" class="img-fluid w-100"
                                alt="{{ $berita->judul }}" style="max-height: 450px; object-fit: cover;">
                        </div>
                    @else
                        <div class="mb-4 overflow-hidden rounded-4 bg-light d-flex flex-column justify-content-center align-items-center text-muted" 
                            style="height: 300px; border: 2px dashed #cbd5e1;">
                            <i class="fas fa-image fa-3x mb-3 text-secondary"></i>
                            <span class="fw-bold">Tidak ada gambar</span>
                        </div>
                    @endif

                    <!-- Konten Berita -->
                    <div class="text-secondary article-content" style="line-height: 1.8; font-size: 1.05rem;">
                        {!! $berita->konten !!}
                    </div>

                    <!-- Navigasi Kembali -->
                    <div class="mt-5 pt-4 border-top">
                        <a href="{{ route('berita.index') }}" class="btn btn-outline-primary rounded-pill px-4 fw-bold">
                            &larr; Kembali ke Daftar Berita
                        </a>
                    </div>
                </div>
            </div>

            <!-- Kolom Samping: Berita Terbaru / Rekomendasi -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 sticky-top" style="top: 100px;">
                    <h5 class="fw-bold text-dark mb-4">Berita Terbaru</h5>

                    <div class="d-flex flex-column gap-4">
                        @forelse($beritaTerbaru as $item)
                            <div class="d-flex align-items-center gap-3">
                                @if ($item->gambar)
                                    <img src="{{ asset('storage/' . $item->gambar) }}" class="rounded-3 shadow-sm"
                                        alt="{{ $item->judul }}" style="width: 80px; height: 80px; object-fit: cover;">
                                @else
                                    <div class="bg-light rounded-3 d-flex align-items-center justify-content-center text-muted shadow-sm"
                                        style="width: 80px; height: 80px; min-width: 80px; border: 1px dashed #cbd5e1;">
                                        <i class="fas fa-image"></i>
                                    </div>
                                @endif
                                <div>
                                    <h6 class="mb-1 fw-bold" style="font-size: 0.95rem; line-height: 1.4;">
                                        <a href="{{ route('berita.detail', $item->slug) }}"
                                            class="text-dark text-decoration-none sidebar-news-link transition-smooth">
                                            {{ \Illuminate\Support\Str::limit($item->judul, 45) }}
                                        </a>
                                    </h6>
                                    <small class="text-muted" style="font-size: 0.8rem;">
                                        <i class="far fa-calendar-alt me-1"></i> {{ $item->created_at->format('d M Y') }}
                                    </small>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted small mb-0">Belum ada berita lainnya.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@extends('layouts.front')

@section('content')
    <style>
        .book-cover-detail {
            width: 100%;
            max-width: 300px;
            border-radius: 12px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        }

        .detail-label {
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #6c757d;
            font-weight: 600;
            margin-bottom: 2px;
        }

        .detail-value {
            font-size: 1.05rem;
            color: #212529;
            font-weight: 500;
            margin-bottom: 15px;
        }

        .related-book-card {
            transition: transform 0.3s ease;
        }

        .related-book-card:hover {
            transform: translateY(-5px);
        }
    </style>

    <div class="container py-5">
        <!-- Breadcrumb Navigasi -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb bg-transparent p-0 m-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('opac.index') }}" class="text-decoration-none">OPAC</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $buku->judul }}</li>
            </ol>
        </nav>

        <!-- Bagian Utama Detail Buku -->
        <div class="row mb-5 bg-white p-4 p-md-5 rounded-4 shadow-sm border">
            <!-- Kolom Kiri: Cover, Status & Action -->
            <div class="col-md-4 text-center mb-4 mb-md-0">
                @if ($buku->cover)
                    <img src="{{ asset('storage/' . $buku->cover) }}" alt="{{ $buku->judul }}"
                        class="book-cover-detail mb-4">
                @else
                    <!-- Pengganti No Cover untuk Detail Utama -->
                    <div class="book-cover-detail bg-light d-flex flex-column align-items-center justify-content-center mb-4 text-muted mx-auto"
                        style="height: 420px; border: 2px dashed #cbd5e1;">
                        <i class="fas fa-image fa-3x mb-3 text-secondary"></i>
                        <span class="fw-bold">No Cover</span>
                    </div>
                @endif

                <!-- Status Ketersediaan Fisik -->
                <div class="d-grid gap-2 text-center mx-auto mb-3" style="max-width: 300px;">
                    @if (isset($buku->stok) && $buku->stok > 0)
                        <div class="alert alert-success border-0 py-2 font-weight-bold mb-0">
                            <i class="fas fa-check-circle mr-2"></i> Fisik Tersedia ({{ $buku->stok }})
                        </div>
                    @else
                        <div class="alert alert-danger border-0 py-2 font-weight-bold mb-0">
                            <i class="fas fa-clock mr-2"></i> Fisik Sedang Dipinjam
                        </div>
                    @endif
                </div>

                <!-- Tombol Baca E-Book Jika Tersedia -->
                @if ($buku->file_ebook)
                    <div class="text-center mx-auto" style="max-width: 300px;">
                        <a href="{{ asset('storage/' . $buku->file_ebook) }}" target="_blank"
                            class="btn btn-primary btn-block rounded-pill font-weight-bold shadow-sm py-2">
                            <i class="fas fa-book-reader mr-2"></i> Baca E-Book Sekarang
                        </a>
                        <small class="text-success mt-2 d-block font-weight-bold">
                            <i class="fas fa-check-circle"></i> E-Book tersedia untuk dibaca online
                        </small>
                    </div>
                @endif
            </div>

            <!-- Kolom Kanan: Informasi Lengkap -->
            <div class="col-md-8 pl-md-4">
                <span class="badge badge-primary px-3 py-2 rounded-pill mb-3">
                    {{ $buku->kategori->nama ?? 'Umum' }}
                </span>

                <h1 class="font-weight-bold mb-2">{{ $buku->judul }}</h1>
                <h5 class="text-muted mb-4"><i class="fas fa-pen-nib mr-2"></i>{{ $buku->penulis }}</h5>

                <hr class="mb-4">

                <div class="row">
                    <div class="col-sm-6">
                        <div class="detail-label">Penerbit</div>
                        <div class="detail-value">{{ $buku->penerbit ?? '-' }}</div>
                    </div>
                    <div class="col-sm-6">
                        <div class="detail-label">Tahun Terbit</div>
                        <div class="detail-value">{{ $buku->tahun_terbit ?? '-' }}</div>
                    </div>
                    <div class="col-sm-6">
                        <div class="detail-label">ISBN</div>
                        <div class="detail-value">{{ $buku->isbn ?? 'Tidak ada ISBN' }}</div>
                    </div>
                    <div class="col-sm-6">
                        <div class="detail-label">Lokasi Rak</div>
                        <div class="detail-value text-primary font-weight-bold">
                            <i class="fas fa-map-marker-alt mr-1"></i> {{ $buku->rak ?? 'Belum Diatur' }}
                        </div>
                    </div>
                </div>

                <h5 class="font-weight-bold mt-4 mb-3">Sinopsis / Deskripsi</h5>
                <div class="text-secondary" style="line-height: 1.8;">
                    {{-- Gunakan {!! !!} jika sinopsis disimpan menggunakan WYSIWYG editor (menyimpan tag HTML) --}}
                    {!! $buku->deskripsi ?? '<p class="text-muted"><i>Tidak ada deskripsi tersedia untuk buku ini.</i></p>' !!}
                </div>
            </div>
        </div>

        <!-- Bagian Buku Terkait (Rekomendasi) -->
        @if (isset($bukuTerkait) && $bukuTerkait->count() > 0)
            <div class="mt-5">
                <h4 class="font-weight-bold mb-4 border-left border-primary border-4 pl-3">Mungkin Anda Juga Suka</h4>
                <div class="row">
                    @foreach ($bukuTerkait as $terkait)
                        <div class="col-6 col-md-3 mb-4">
                            <a href="{{ route('opac.show', $terkait->slug) }}" class="text-decoration-none">
                                <div class="card h-100 border-0 shadow-sm rounded-4 related-book-card">
                                    @if ($terkait->cover)
                                        <img src="{{ asset('storage/' . $terkait->cover) }}" class="card-img-top p-3"
                                            style="height: 200px; object-fit: contain;" alt="{{ $terkait->judul }}">
                                    @else
                                        <!-- Pengganti No Cover untuk Buku Terkait -->
                                        <div class="card-img-top bg-light d-flex flex-column align-items-center justify-content-center text-muted p-3"
                                            style="height: 200px; border-bottom: 1px solid #f1f5f9;">
                                            <i class="fas fa-image fa-2x mb-2 text-secondary"></i>
                                            <small class="fw-bold">No Cover</small>
                                        </div>
                                    @endif
                                    <div class="card-body py-2 px-3 text-center">
                                        <h6 class="card-title text-dark font-weight-bold text-truncate m-0">
                                            {{ $terkait->judul }}</h6>
                                        <small class="text-muted">{{ $terkait->penulis }}</small>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection

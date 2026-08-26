@extends('layouts.master')

@section('title', 'Katalog Buku - SIPERPUS')

@section('content')
    <div class="content-wrapper bg-light">
        <!-- Content Header (Berdasarkan Template Dasar) -->
        <div class="content-header pt-4 pb-3">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h3 class="m-0 font-weight-bold text-dark">Katalog Buku (OPAC)</h3>
                        <p class="text-muted small mb-0">Cari dan temukan buku yang ingin Anda baca di perpustakaan.</p>
                    </div>
                    <!-- Breadcrumb -->
                    <div class="col-sm-6 text-sm-right mt-2 mt-sm-0">
                        <ol class="breadcrumb float-sm-right bg-transparent p-0 m-0">
                            <li class="breadcrumb-item"><a href="{{ route('anggota.dashboard') }}"
                                    class="text-primary">Dashboard</a></li>
                            <li class="breadcrumb-item active">Katalog Buku</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <section class="content">
            <div class="container-fluid">

                <!-- Card Utama -->
                <div class="card border-0 shadow-sm rounded-lg mb-5">

                    <div
                        class="card-header bg-white py-3 d-flex flex-column flex-md-row align-items-center justify-content-between border-0 shadow-sm mb-4 rounded">
                        <h5 class="card-title mb-3 mb-md-0 font-weight-bold text-dark">
                            <i class="fas fa-book text-primary mr-2"></i>Koleksi Buku
                        </h5>

                        <div class="w-100" style="max-width: 700px;">
                            <form action="{{ route('anggota.katalog.index') }}" method="GET"
                                class="d-flex flex-column flex-md-row gap-2">

                                <!-- Dropdown Kategori -->
                                <select name="kategori_id" class="form-control form-control-sm mb-2 mb-md-0 mr-md-2"
                                    onchange="this.form.submit()">
                                    <option value="">-- Semua Kategori --</option>
                                    @foreach ($kategoris as $kat)
                                        <option value="{{ $kat->id }}"
                                            {{ request('kategori_id') == $kat->id ? 'selected' : '' }}>
                                            {{ $kat->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>

                                <!-- Dropdown Format -->
                                <select name="format" class="form-control form-control-sm mb-2 mb-md-0 mr-md-2"
                                    onchange="this.form.submit()">
                                    <option value="">-- Semua Format --</option>
                                    <option value="ebook" {{ request('format') == 'ebook' ? 'selected' : '' }}>Hanya E-Book
                                    </option>
                                    <option value="fisik" {{ request('format') == 'fisik' ? 'selected' : '' }}>Hanya Buku
                                        Fisik</option>
                                </select>

                                <!-- Kotak Pencarian -->
                                <div class="input-group input-group-sm w-100">
                                    <input type="text" name="search" class="form-control"
                                        placeholder="Cari judul, penulis..." value="{{ request('search') }}">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary px-3">
                                            <i class="fas fa-search"></i>
                                        </button>
                                        <!-- Tombol Reset (Muncul jika ada filter aktif) -->
                                        @if (request()->anyFilled(['search', 'kategori_id', 'format']))
                                            <a href="{{ route('anggota.katalog.index') }}" class="btn btn-danger px-3"
                                                title="Hapus Filter">
                                                <i class="fas fa-times"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>

                    <!-- Card Body (Grid Buku) -->
                    <div class="card-body p-4 bg-light">
                        <div class="row">
                            @forelse ($buku as $item)
                                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                                    <div class="card h-100 border-0 shadow-sm rounded-lg book-card">
                                        <!-- Foto Sampul (Disesuaikan dengan kolom 'cover' pada migrasi) -->
                                        <div class="position-relative bg-white border-bottom text-center overflow-hidden"
                                            style="height: 260px;">
                                            @if ($item->cover)
                                                <img src="{{ asset('storage/' . $item->cover) }}" alt="{{ $item->judul }}"
                                                    class="img-fluid h-100 w-100"
                                                    style="object-fit: cover; transition: transform .3s ease;">
                                            @else
                                                <div
                                                    class="d-flex align-items-center justify-content-center h-100 w-100 bg-secondary text-white">
                                                    <i class="fas fa-book fa-4x" style="opacity: 0.3;"></i>
                                                </div>
                                            @endif

                                            <!-- Badge Ketersediaan -->
                                            <div class="position-absolute" style="top: 10px; right: 10px;">
                                                @if ($item->stok > 0)
                                                    <span class="badge badge-success px-2 py-1 shadow-sm">Tersedia
                                                        ({{ $item->stok }})
                                                    </span>
                                                @else
                                                    <span class="badge badge-danger px-2 py-1 shadow-sm">Habis</span>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Informasi Buku -->
                                        <div class="card-body d-flex flex-column p-3 bg-white">
                                            <h6 class="font-weight-bold text-dark mb-1 text-truncate"
                                                title="{{ $item->judul }}">
                                                {{ $item->judul }}
                                            </h6>
                                            <div class="small text-muted mb-1 text-truncate" title="{{ $item->penulis }}">
                                                <i class="fas fa-user-edit mr-1 w-15px text-center"></i>
                                                {{ $item->penulis ?? 'Penulis Tidak Diketahui' }}
                                            </div>
                                            <div class="small text-muted mb-3 text-truncate">
                                                <i class="fas fa-building mr-1 w-15px text-center"></i>
                                                {{ $item->penerbit ?? '-' }} ({{ $item->tahun_terbit ?? '-' }})
                                            </div>

                                            <!-- Tombol Aksi -->
                                            <a href="{{ route('anggota.katalog.show', $item->slug) }}"
                                                class="btn btn-outline-primary btn-sm btn-block rounded font-weight-bold">
                                                Lihat Detail
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12 text-center py-5">
                                    <i class="fas fa-search fa-3x mb-3 text-black-50"></i>
                                    <h6 class="font-weight-bold text-secondary">Buku Tidak Ditemukan</h6>
                                    <p class="text-muted small">Coba gunakan kata kunci pencarian yang lain.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Card Footer (Pagination seperti di Data Anggota) -->
                    @if ($buku->hasPages())
                        <div
                            class="card-footer bg-white border-top py-3 d-flex flex-column flex-md-row align-items-center justify-content-between">
                            <span class="text-muted small mb-2 mb-md-0">
                                Menampilkan <strong>{{ $buku->firstItem() }}</strong> -
                                <strong>{{ $buku->lastItem() }}</strong> dari <strong>{{ $buku->total() }}</strong>
                                buku
                            </span>
                            <div>
                                {{ $buku->withQueryString()->links() }}
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </section>
    </div>

@endsection

@push('styles')
    <style>
        /* Sedikit efek visual saat kursor diarahkan ke kartu buku */
        .book-card {
            transition: all 0.3s ease;
        }

        .book-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important;
        }

        .book-card:hover img {
            transform: scale(1.05);
        }

        .w-15px {
            width: 15px;
            display: inline-block;
        }
    </style>
@endpush

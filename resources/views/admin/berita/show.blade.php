@extends('layouts.master')

@section('title', 'Detail Berita - SIPERPUS')

@section('content')
    <div class="content-wrapper bg-light">
        <!-- Content Header -->
        <div class="content-header pt-4 pb-3">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h3 class="m-0 font-weight-bold text-dark">Baca Publikasi</h3>
                        <p class="text-muted small mb-0">Pratinjau tampilan publikasi perpustakaan.</p>
                    </div>
                    <div class="col-sm-6 text-sm-right mt-2 mt-sm-0">
                        <ol class="breadcrumb float-sm-right bg-transparent p-0 m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"
                                    class="text-primary">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.berita.index') }}"
                                    class="text-primary">Data Berita</a></li>
                            <li class="breadcrumb-item active">Detail</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content pb-5">
            <div class="container-fluid">
                <!-- Wrapper Artikel -->
                <div class="card border-0 shadow-sm rounded-lg mx-auto" style="max-width: 900px;">
                    <!-- Aksi & Navigasi -->
                    <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                        <a href="{{ route('admin.berita.index') }}"
                            class="btn btn-light border btn-sm font-weight-bold text-muted shadow-sm">
                            <i class="fas fa-arrow-left mr-1"></i> Kembali
                        </a>
                        <a href="{{ route('admin.berita.edit', $berita->id) }}"
                            class="btn btn-warning btn-sm font-weight-bold text-white shadow-sm px-3">
                            <i class="fas fa-edit mr-1"></i> Edit Berita
                        </a>
                    </div>

                    <!-- Konten Utama Artikel -->
                    <div class="card-body p-4 p-md-5">

                        <!-- Header Artikel -->
                        <div class="text-center mb-4">
                            <div class="mb-3">
                                <span
                                    class="badge badge-info px-3 py-2 shadow-sm rounded-pill text-uppercase mr-1">{{ $berita->kategori }}</span>
                                @if ($berita->is_published)
                                    <span class="badge badge-success px-3 py-2 shadow-sm rounded-pill text-uppercase"><i
                                            class="fas fa-globe mr-1"></i> Tayang</span>
                                @else
                                    <span class="badge badge-secondary px-3 py-2 shadow-sm rounded-pill text-uppercase"><i
                                            class="fas fa-eye-slash mr-1"></i> Draft</span>
                                @endif
                            </div>
                            <h2 class="font-weight-bold text-dark mb-3" style="line-height: 1.4;">{{ $berita->judul }}</h2>
                            <div class="text-muted mb-4 pb-3 border-bottom">
                                <span class="mr-3"><i class="far fa-calendar-alt mr-1"></i>
                                    {{ $berita->created_at->translatedFormat('d F Y') }}</span>
                                <span><i class="far fa-clock mr-1"></i> {{ $berita->created_at->translatedFormat('H:i') }}
                                    WIB</span>
                            </div>
                        </div>

                        <!-- Gambar Artikel -->
                        @if ($berita->gambar)
                            <div class="mb-5 text-center">
                                <img src="{{ asset('storage/' . $berita->gambar) }}"
                                    class="img-fluid rounded-lg shadow-sm w-100"
                                    style="max-height: 450px; object-fit: cover; border: 1px solid #f0f0f0;">
                            </div>
                        @endif

                        <!-- Body Artikel -->
                        <div class="article-content" style="font-size: 1.05rem; line-height: 1.8; color: #444;">
                            {!! $berita->konten !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('styles')
    <!-- Sedikit perbaikan style untuk konten yang dirender Summernote agar lebih rapi saat dibaca -->
    <style>
        .article-content img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 1rem;
        }

        .article-content iframe {
            max-width: 100%;
            border-radius: 8px;
        }

        .article-content a {
            color: #007bff;
            text-decoration: underline;
        }
    </style>
@endpush

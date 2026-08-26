@extends('layouts.master')

@section('title', 'Detail Buku - SIPERPUS')

@section('content')
    <style>
        .badge-soft-primary {
            background-color: #e6f0ff;
            color: #0d6efd;
            border: 1px solid #b6d4fe;
        }

        .badge-soft-success {
            background-color: #e6f6ec;
            color: #28a745;
            border: 1px solid #a3e6cd;
        }

        .badge-soft-warning {
            background-color: #fef5e5;
            color: #fd7e14;
            border: 1px solid #fecba1;
        }

        .badge-soft-danger {
            background-color: #fdf5f6;
            color: #dc3545;
            border: 1px solid #f8d7da;
        }

        .badge-soft-info {
            background-color: #e6f7ff;
            color: #0dcaf0;
            border: 1px solid #9eeaf9;
        }

        .badge-soft-secondary {
            background-color: #f1f3f5;
            color: #6c757d;
            border: 1px solid #ced4da;
        }

        .meta-label {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #6c757d;
            font-weight: 600;
            margin-bottom: 0.25rem;
            display: block;
        }

        .meta-value {
            font-size: 1rem;
            font-weight: 500;
            color: #343a40;
        }
    </style>

    <div class="content-wrapper bg-light">
        <div class="content-header pt-4 pb-3">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h3 class="m-0 font-weight-bold text-dark">Detail Buku</h3>
                    </div>
                    <div class="col-sm-6 text-sm-right mt-2 mt-sm-0">
                        <ol class="breadcrumb float-sm-right bg-transparent p-0 m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.buku.index') }}" class="text-primary">Data
                                    Buku</a></li>
                            <li class="breadcrumb-item active">Detail</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="card border-0 shadow-sm rounded-lg mb-5">
                    <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center">
                        <h6 class="font-weight-bold text-primary mb-0">
                            <i class="fas fa-book-reader mr-2"></i>Informasi Lengkap Buku
                        </h6>
                        <div class="d-flex">
                            <a href="{{ route('admin.buku.edit', $buku->id) }}"
                                class="btn btn-warning btn-sm text-white font-weight-bold px-3 mr-2 shadow-sm">
                                <i class="fas fa-edit mr-1"></i> Edit
                            </a>
                            <a href="{{ route('admin.buku.index') }}"
                                class="btn btn-secondary btn-sm px-3 font-weight-bold shadow-sm">
                                <i class="fas fa-arrow-left mr-1"></i> Kembali
                            </a>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <div class="row">
                            <!-- Sisi Kiri (Cover & Action) -->
                            <div class="col-lg-3 col-md-4 text-center mb-4 mb-md-0">
                                <div class="position-relative d-inline-block w-100 mb-3">
                                    @if ($buku->cover)
                                        <img src="{{ asset('storage/' . $buku->cover) }}" alt="Cover Buku"
                                            class="img-fluid rounded-lg shadow"
                                            style="max-height: 400px; width: 100%; object-fit: cover;">
                                    @else
                                        <div class="bg-light rounded-lg border d-flex align-items-center justify-content-center text-muted shadow-sm mx-auto"
                                            style="height: 350px; width: 100%;">
                                            <div class="text-center">
                                                <i class="fas fa-image fa-4x mb-3 text-black-50"></i>
                                                <p class="mb-0 font-weight-medium">Cover Belum Tersedia</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                @if ($buku->file_ebook)
                                    <a href="{{ asset('storage/' . $buku->file_ebook) }}" target="_blank"
                                        class="btn btn-success btn-lg btn-block shadow-sm font-weight-bold"
                                        style="border-radius: 8px;">
                                        <i class="fas fa-file-pdf mr-2"></i> Baca E-Book PDF
                                    </a>
                                @endif
                            </div>

                            <!-- Sisi Kanan (Metadata & Deskripsi) -->
                            <div class="col-lg-9 col-md-8 pl-md-4">
                                <!-- Header Info -->
                                <div class="mb-4 pb-3 border-bottom">
                                    <h3 class="font-weight-bold text-dark mb-2">{{ $buku->judul }}</h3>
                                    <h5 class="text-secondary mb-0">
                                        <i
                                            class="fas fa-pen-nib mr-2 text-muted"></i>{{ $buku->penulis ?? 'Penulis Tidak Diketahui' }}
                                    </h5>
                                </div>

                                <!-- Grid Informasi Metadata -->
                                <div class="row mb-4">
                                    <div class="col-sm-6 col-lg-4 mb-4">
                                        <span class="meta-label">Kode Buku</span>
                                        <div class="meta-value">
                                            <span class="badge badge-soft-secondary px-2 py-1" style="font-size: 0.9rem;">
                                                <i class="fas fa-barcode mr-1"></i> {{ $buku->kode_buku }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-4 mb-4">
                                        <span class="meta-label">Kategori</span>
                                        <div class="meta-value">
                                            <span class="badge badge-soft-info px-2 py-1" style="font-size: 0.9rem;">
                                                <i class="fas fa-tag mr-1"></i> {{ $buku->kategori->nama_kategori ?? '-' }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-4 mb-4">
                                        <span class="meta-label">Lokasi Rak</span>
                                        <div class="meta-value">
                                            <i class="fas fa-map-marker-alt text-danger mr-1"></i>
                                            {{ $buku->rak ?? 'Belum Diatur' }}
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-4 mb-4 mb-lg-0">
                                        <span class="meta-label">ISBN</span>
                                        <div class="meta-value">{{ $buku->isbn ?? '-' }}</div>
                                    </div>
                                    <div class="col-sm-6 col-lg-4 mb-4 mb-lg-0">
                                        <span class="meta-label">Penerbit</span>
                                        <div class="meta-value">
                                            {{ $buku->penerbit ?? '-' }}
                                            <span class="text-muted small ml-1">({{ $buku->tahun_terbit ?? '-' }})</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-4">
                                        <span class="meta-label">Jumlah Buku</span>
                                        <div class="meta-value">
                                            @if ($buku->stok > 0)
                                                <span class="badge badge-soft-success px-2 py-1" style="font-size: 0.9rem;">
                                                    <i class="fas fa-layer-group mr-1"></i> {{ $buku->stok }} Buku
                                                </span>
                                            @else
                                                <span class="badge badge-soft-danger px-2 py-1" style="font-size: 0.9rem;">
                                                    <i class="fas fa-times-circle mr-1"></i> Habis
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Box Sinopsis -->
                                <div class="bg-light p-4 rounded-lg border-left border-primary shadow-sm"
                                    style="border-width: 4px !important;">
                                    <h6 class="font-weight-bold text-dark mb-2">
                                        <i class="fas fa-align-left mr-2 text-primary"></i>Sinopsis / Deskripsi
                                    </h6>
                                    <p class="text-justify text-muted mb-0" style="line-height: 1.8; font-size: 0.95rem;">
                                        {{ $buku->deskripsi ?: 'Buku ini belum memiliki sinopsis atau deskripsi tambahan yang dicatat oleh pengelola perpustakaan.' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

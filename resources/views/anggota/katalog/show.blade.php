@extends('layouts.master')

@section('title', 'Detail Buku - SIPERPUS')

@section('content')
    <div class="content-wrapper bg-light">
        <div class="content-header pt-4 pb-3">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h3 class="m-0 font-weight-bold text-dark">Detail Buku</h3>
                    </div>
                    <div class="col-sm-6 text-sm-right mt-2 mt-sm-0">
                        <ol class="breadcrumb float-sm-right bg-transparent p-0 m-0">
                            <li class="breadcrumb-item"><a href="{{ route('anggota.dashboard') }}"
                                    class="text-primary">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('anggota.katalog.index') }}"
                                    class="text-primary">Katalog</a></li>
                            <li class="breadcrumb-item active">Detail</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="card border-0 shadow-sm rounded-lg mb-5">
                    <div class="card-body p-4">
                        <div class="row">
                            <!-- Kolom Gambar -->
                            <div class="col-md-4 mb-4 mb-md-0 text-center">
                                <div class="bg-light rounded p-3 border">
                                    @if ($buku->cover)
                                        <img src="{{ asset('storage/' . $buku->cover) }}" alt="{{ $buku->judul }}"
                                            class="img-fluid rounded shadow-sm"
                                            style="max-height: 400px; object-fit: cover;">
                                    @else
                                        <div class="d-flex align-items-center justify-content-center bg-secondary rounded text-white"
                                            style="height: 350px;">
                                            <i class="fas fa-book fa-5x" style="opacity: 0.3;"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="mt-3">
                                    @if ($buku->stok > 0)
                                        <span class="badge badge-success px-3 py-2 text-uppercase"
                                            style="font-size: 0.9rem;">Tersedia ({{ $buku->stok }} Buku)</span>
                                    @else
                                        <span class="badge badge-danger px-3 py-2 text-uppercase"
                                            style="font-size: 0.9rem;">Stok Habis</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Kolom Informasi -->
                            <div class="col-md-8">
                                <h3 class="font-weight-bold text-dark mb-1">{{ $buku->judul }}</h3>
                                <h6 class="text-muted mb-4"><i
                                        class="fas fa-user-edit mr-2"></i>{{ $buku->penulis ?? 'Penulis Tidak Diketahui' }}
                                </h6>

                                <table class="table table-sm table-borderless mb-4">
                                    <tbody>
                                        <tr>
                                            <td width="30%" class="text-muted">Kode Buku</td>
                                            <td class="font-weight-bold">: {{ $buku->kode_buku ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">ISBN</td>
                                            <td class="font-weight-bold">: {{ $buku->isbn ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Penerbit</td>
                                            <td class="font-weight-bold">: {{ $buku->penerbit ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Tahun Terbit</td>
                                            <td class="font-weight-bold">: {{ $buku->tahun_terbit ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-muted">Lokasi Rak</td>
                                            <td class="font-weight-bold text-primary">:
                                                {{ $buku->rak ?? 'Belum Ditentukan' }}</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <h6 class="font-weight-bold text-dark border-bottom pb-2 mb-3">Sinopsis / Deskripsi</h6>
                                <div class="text-muted text-justify" style="line-height: 1.7;">
                                    {!! $buku->deskripsi ?? '<em>Tidak ada deskripsi tersedia untuk buku ini.</em>' !!}
                                </div>

                                <div class="mt-4 pt-3 border-top">
                                    <a href="{{ route('anggota.katalog.index') }}" class="btn btn-secondary px-4">
                                        <i class="fas fa-arrow-left mr-1"></i> Kembali ke Katalog
                                    </a>
                                    <!-- Cek apakah kolom file_ebook di database ada isinya -->
                                    @if ($buku->file_ebook)
                                        <a href="{{ asset('storage/' . $buku->file_ebook) }}"
                                            class="btn btn-primary shadow-sm" target="_blank">
                                            <i class="fas fa-book-reader mr-1"></i> Baca Ebook
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

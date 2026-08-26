@extends('layouts.master')

@section('title', 'Berita & Informasi - SIPERPUS')

@section('content')
    <div class="content-wrapper bg-light">
        <div class="content-header pt-4 pb-3">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h3 class="m-0 font-weight-bold text-dark">Berita & Informasi</h3>
                        <p class="text-muted small mb-0">Ikuti pengumuman dan kabar terbaru dari perpustakaan.</p>
                    </div>
                    <div class="col-sm-6 text-sm-right mt-2 mt-sm-0">
                        <ol class="breadcrumb float-sm-right bg-transparent p-0 m-0">
                            <li class="breadcrumb-item"><a href="{{ route('anggota.dashboard') }}"
                                    class="text-primary">Dashboard</a></li>
                            <li class="breadcrumb-item active">Berita</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    @forelse ($berita as $item)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 border-0 shadow-sm rounded-lg news-card">
                                <div class="position-relative overflow-hidden rounded-top text-center bg-white"
                                    style="height: 200px;">
                                    @if ($item->gambar)
                                        <img src="{{ asset('storage/' . $item->gambar) }}" class="img-fluid w-100 h-100"
                                            style="object-fit: cover; transition: transform .3s;" alt="{{ $item->judul }}">
                                    @else
                                        <div
                                            class="d-flex align-items-center justify-content-center h-100 bg-secondary text-white">
                                            <i class="fas fa-newspaper fa-4x" style="opacity: 0.5;"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="card-body d-flex flex-column p-4">
                                    <div class="mb-2 text-muted small">
                                        <i class="far fa-calendar-alt mr-1"></i>
                                        {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d M Y') }}
                                    </div>
                                    <h5 class="font-weight-bold text-dark mb-3">{{ $item->judul }}</h5>
                                    <!-- Menampilkan cuplikan konten (menghapus tag HTML) -->
                                    <p class="text-muted small mb-4">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($item->konten), 120, '...') }}
                                    </p>
                                    <div class="mt-auto">
                                        <a href="{{ route('anggota.berita.show', $item->id) }}"
                                            class="btn btn-outline-primary btn-sm rounded font-weight-bold px-3">Baca
                                            Selengkapnya <i class="fas fa-arrow-right ml-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5">
                            <i class="far fa-newspaper fa-3x mb-3 text-black-50"></i>
                            <h6 class="font-weight-bold text-secondary">Belum Ada Berita</h6>
                            <p class="text-muted small">Belum ada informasi terbaru dari perpustakaan saat ini.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-3 mb-5">
                    {{ $berita->links() }}
                </div>
            </div>
        </section>
    </div>

    <style>
        .news-card:hover img {
            transform: scale(1.05);
        }
    </style>
@endsection

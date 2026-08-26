@extends('layouts.master')

@section('title', $berita->judul . ' - SIPERPUS')

@section('content')
    <div class="content-wrapper bg-light">
        <div class="content-header pt-4 pb-3">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-sm-8">
                        <h3 class="m-0 font-weight-bold text-dark">Baca Artikel</h3>
                    </div>
                    <div class="col-sm-4 text-sm-right mt-2 mt-sm-0">
                        <a href="{{ route('anggota.berita.index') }}" class="btn btn-secondary btn-sm rounded"><i
                                class="fas fa-arrow-left mr-1"></i> Kembali</a>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="card border-0 shadow-sm rounded-lg mb-5 overflow-hidden">
                            <!-- Banner Berita -->
                            @if ($berita->gambar)
                                <div style="height: 350px; overflow: hidden; background-color: #f8f9fa;">
                                    <img src="{{ asset('storage/' . $berita->gambar) }}" class="w-100 h-100"
                                        style="object-fit: cover;" alt="Banner Berita">
                                </div>
                            @endif

                            <div class="card-body p-4 p-md-5">
                                <div class="text-center mb-4">
                                    <h2 class="font-weight-bold text-dark mb-3">{{ $berita->judul }}</h2>
                                    <div class="text-muted">
                                        <i class="far fa-calendar-check mr-2"></i>Diterbitkan pada
                                        {{ \Carbon\Carbon::parse($berita->created_at)->translatedFormat('d M Y, H:i') }}
                                    </div>
                                </div>

                                <hr class="mb-4">

                                <!-- Isi Konten Berita -->
                                <div class="text-dark text-justify" style="line-height: 1.8; font-size: 1.05rem;">
                                    {!! $berita->konten !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

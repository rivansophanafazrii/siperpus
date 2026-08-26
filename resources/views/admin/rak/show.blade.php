@extends('layouts.master')

@section('title', 'Detail Rak Buku - SIPERPUS')

@section('content')
    <style>
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
    </style>

    <div class="content-wrapper bg-light">
        <div class="content-header pt-4 pb-3">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h3 class="m-0 font-weight-bold text-dark">Detail Rak</h3>
                        <p class="text-muted small mb-0">Informasi lengkap mengenai rak penyimpanan buku.</p>
                    </div>
                    <div class="col-sm-6 text-sm-right mt-2 mt-sm-0">
                        <ol class="breadcrumb float-sm-right bg-transparent p-0 m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.rak.index') }}"
                                    class="text-primary text-decoration-none">Rak Buku</a></li>
                            <li class="breadcrumb-item active">Detail Rak</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8 col-lg-7 mb-4">
                        <div class="card border-0 shadow-sm rounded-lg h-100">
                            <div
                                class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center">
                                <h5 class="font-weight-bold text-dark mb-0">
                                    <i class="fas fa-info-circle text-primary mr-2"></i>Informasi Rak
                                </h5>
                                <a href="{{ route('admin.rak.edit', $rak->id) }}"
                                    class="btn btn-warning btn-sm text-white font-weight-bold px-3 shadow-sm rounded">
                                    <i class="fas fa-edit mr-1"></i> Edit
                                </a>
                            </div>

                            <div class="card-body p-0">
                                <table class="table table-hover align-middle mb-0">
                                    <tbody>
                                        <tr>
                                            <th width="35%" class="text-muted border-top-0 py-3 pl-4">Nama Rak</th>
                                            <td class="font-weight-bold text-dark border-top-0 py-3 pr-4">
                                                {{ $rak->nama_rak }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-muted py-3 pl-4">Lokasi Penyimpanan</th>
                                            <td class="py-3 pr-4">
                                                <span class="badge badge-soft-info px-2 py-1">
                                                    <i class="fas fa-map-marker-alt mr-1"></i> {{ $rak->lokasi }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="text-muted py-3 pl-4">Keterangan Tambahan</th>
                                            <td class="py-3 pr-4 text-dark" style="white-space: normal; line-height: 1.6;">
                                                {{ $rak->keterangan ?: 'Tidak ada keterangan yang ditambahkan.' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="text-muted py-3 pl-4 border-bottom-0">Tanggal Dibuat</th>
                                            <td class="py-3 pr-4 text-dark border-bottom-0">
                                                <i
                                                    class="far fa-calendar-alt text-black-50 mr-2"></i>{{ $rak->created_at->translatedFormat('d F Y, H:i') }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer bg-white border-top py-3 px-4">
                                <a href="{{ route('admin.rak.index') }}"
                                    class="btn btn-light border btn-sm px-4 shadow-sm font-weight-bold">
                                    <i class="fas fa-arrow-left mr-1"></i> Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

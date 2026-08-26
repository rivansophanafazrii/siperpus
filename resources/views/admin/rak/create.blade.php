@extends('layouts.master')

@section('title', 'Tambah Rak Buku - SIPERPUS')

@section('content')
    <style>
        .form-control:focus {
            background-color: #fff !important;
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }
    </style>

    <div class="content-wrapper bg-light">
        <div class="content-header pt-4 pb-3">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h3 class="m-0 font-weight-bold text-dark">Tambah Rak</h3>
                        <p class="text-muted small mb-0">Tambahkan data lokasi fisik rak buku baru ke dalam sistem.</p>
                    </div>
                    <div class="col-sm-6 text-sm-right mt-2 mt-sm-0">
                        <ol class="breadcrumb float-sm-right bg-transparent p-0 m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.rak.index') }}"
                                    class="text-primary text-decoration-none">Rak Buku</a></li>
                            <li class="breadcrumb-item active">Tambah Data</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8 col-lg-7 mb-4">
                        <div class="card border-0 shadow-sm rounded-lg">
                            <div class="card-header bg-white py-3 border-0">
                                <h5 class="font-weight-bold text-dark mb-0">
                                    <i class="fas fa-plus-circle text-primary mr-2"></i>Form Rak Baru
                                </h5>
                            </div>

                            <form action="{{ route('admin.rak.store') }}" method="POST">
                                @csrf
                                <div class="card-body bg-white pt-2">
                                    <div class="form-group mb-4">
                                        <label for="nama_rak" class="font-weight-bold text-dark">Nama Rak <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="nama_rak" id="nama_rak"
                                            class="form-control bg-light @error('nama_rak') is-invalid @enderror"
                                            value="{{ old('nama_rak') }}" placeholder="Contoh: Rak Fiksi 01, Rak 1A"
                                            required>
                                        @error('nama_rak')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="lokasi" class="font-weight-bold text-dark">Lokasi <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="lokasi" id="lokasi"
                                            class="form-control bg-light @error('lokasi') is-invalid @enderror"
                                            value="{{ old('lokasi') }}" placeholder="Contoh: Lantai 1 Timur" required>
                                        @error('lokasi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-2">
                                        <label for="keterangan" class="font-weight-bold text-dark">Keterangan <span
                                                class="text-muted font-weight-normal">(Opsional)</span></label>
                                        <textarea name="keterangan" id="keterangan" rows="3"
                                            class="form-control bg-light @error('keterangan') is-invalid @enderror"
                                            placeholder="Keterangan tambahan mengenai rak...">{{ old('keterangan') }}</textarea>
                                        @error('keterangan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="card-footer bg-light border-top text-right py-3 px-4">
                                    <a href="{{ route('admin.rak.index') }}"
                                        class="btn btn-light border btn-sm px-4 mr-2 shadow-sm font-weight-bold">
                                        <i class="fas fa-times mr-1"></i> Batal
                                    </a>
                                    <button type="submit" class="btn btn-primary btn-sm px-4 font-weight-bold shadow-sm">
                                        <i class="fas fa-save mr-1"></i> Simpan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

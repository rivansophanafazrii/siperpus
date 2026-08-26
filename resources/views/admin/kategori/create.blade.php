@extends('layouts.master')

@section('title', 'Tambah Kategori Buku - SIPERPUS')

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
                        <h3 class="m-0 font-weight-bold text-dark">Tambah Kategori</h3>
                        <p class="text-muted small mb-0">Tambahkan klasifikasi kategori buku baru ke dalam sistem.</p>
                    </div>
                    <div class="col-sm-6 text-sm-right mt-2 mt-sm-0">
                        <ol class="breadcrumb float-sm-right bg-transparent p-0 m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.kategori.index') }}"
                                    class="text-primary text-decoration-none">Kategori Buku</a></li>
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
                                    <i class="fas fa-plus-circle text-primary mr-2"></i>Form Kategori Baru
                                </h5>
                            </div>

                            <form action="{{ route('admin.kategori.store') }}" method="POST">
                                @csrf
                                <div class="card-body bg-white pt-2">
                                    <div class="form-group mb-4">
                                        <label for="nama_kategori" class="font-weight-bold text-dark">Nama Kategori <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="nama_kategori" id="nama_kategori"
                                            class="form-control bg-light @error('nama_kategori') is-invalid @enderror"
                                            value="{{ old('nama_kategori') }}"
                                            placeholder="Contoh: Fiksi, Sains, Sejarah..." required>
                                        @error('nama_kategori')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-2">
                                        <label for="deskripsi" class="font-weight-bold text-dark">Deskripsi <span
                                                class="text-muted font-weight-normal">(Opsional)</span></label>
                                        <textarea name="deskripsi" id="deskripsi" rows="4" class="form-control bg-light @error('deskripsi') is-invalid @enderror"
                                            placeholder="Keterangan singkat tentang kategori ini...">{{ old('deskripsi') }}</textarea>
                                        @error('deskripsi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="card-footer bg-light border-top text-right py-3 px-4">
                                    <a href="{{ route('admin.kategori.index') }}"
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
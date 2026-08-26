@extends('layouts.master')

@section('title', 'Edit Buku - SIPERPUS')

@section('content')
    <div class="content-wrapper bg-light">
        <div class="content-header pt-4 pb-3">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h3 class="m-0 font-weight-bold text-dark">Edit Buku</h3>
                    </div>
                    <div class="col-sm-6 text-sm-right mt-2 mt-sm-0">
                        <ol class="breadcrumb float-sm-right bg-transparent p-0 m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.buku.index') }}" class="text-primary">Data
                                    Buku</a></li>
                            <li class="breadcrumb-item active">Edit Data</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="card border-0 shadow-sm rounded-lg mb-5">
                    <div class="card-header bg-white py-3 border-bottom-0">
                        <h6 class="font-weight-bold text-primary mb-0">
                            <i class="fas fa-edit mr-2"></i>Form Edit Data Buku
                        </h6>
                    </div>

                    <form action="{{ route('admin.buku.update', $buku->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body bg-white pt-2">
                            <div class="row">
                                <!-- Kolom Kiri -->
                                <div class="col-md-6 pr-md-4">
                                    <div class="form-group mb-4">
                                        <label class="font-weight-bold text-dark">
                                            <i class="fas fa-barcode text-secondary mr-1"></i> Kode Buku <span
                                                class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="kode_buku"
                                            class="form-control form-control-lg text-sm @error('kode_buku') is-invalid @enderror"
                                            value="{{ old('kode_buku', $buku->kode_buku) }}" required>
                                        @error('kode_buku')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-4">
                                        <label class="font-weight-bold text-dark">
                                            <i class="fas fa-book text-secondary mr-1"></i> Judul Buku <span
                                                class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="judul"
                                            class="form-control form-control-lg text-sm @error('judul') is-invalid @enderror"
                                            value="{{ old('judul', $buku->judul) }}" required>
                                        @error('judul')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-4">
                                        <label class="font-weight-bold text-dark">
                                            <i class="fas fa-tag text-secondary mr-1"></i> Kategori Buku <span
                                                class="text-danger">*</span>
                                        </label>
                                        <select name="kategori_id"
                                            class="form-control form-control-lg text-sm custom-select @error('kategori_id') is-invalid @enderror"
                                            required>
                                            <option value="">-- Pilih Kategori --</option>
                                            @foreach ($kategori as $kat)
                                                <option value="{{ $kat->id }}"
                                                    {{ old('kategori_id', $buku->kategori_id) == $kat->id ? 'selected' : '' }}>
                                                    {{ $kat->nama_kategori }}</option>
                                            @endforeach
                                        </select>
                                        @error('kategori_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-4">
                                                <label class="font-weight-bold text-dark">
                                                    <i class="fas fa-fingerprint text-secondary mr-1"></i> ISBN
                                                </label>
                                                <input type="text" name="isbn"
                                                    class="form-control form-control-lg text-sm @error('isbn') is-invalid @enderror"
                                                    value="{{ old('isbn', $buku->isbn) }}">
                                                @error('isbn')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-4">
                                                <label class="font-weight-bold text-dark">
                                                    <i class="fas fa-calendar-alt text-secondary mr-1"></i> Tahun Terbit
                                                </label>
                                                <input type="number" name="tahun_terbit"
                                                    class="form-control form-control-lg text-sm @error('tahun_terbit') is-invalid @enderror"
                                                    value="{{ old('tahun_terbit', $buku->tahun_terbit) }}">
                                                @error('tahun_terbit')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-4">
                                        <label class="font-weight-bold text-dark">
                                            <i class="fas fa-user-edit text-secondary mr-1"></i> Penulis
                                        </label>
                                        <input type="text" name="penulis"
                                            class="form-control form-control-lg text-sm @error('penulis') is-invalid @enderror"
                                            value="{{ old('penulis', $buku->penulis) }}">
                                        @error('penulis')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-4">
                                        <label class="font-weight-bold text-dark">
                                            <i class="fas fa-building text-secondary mr-1"></i> Penerbit
                                        </label>
                                        <input type="text" name="penerbit"
                                            class="form-control form-control-lg text-sm @error('penerbit') is-invalid @enderror"
                                            value="{{ old('penerbit', $buku->penerbit) }}">
                                        @error('penerbit')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Kolom Kanan -->
                                <div class="col-md-6 pl-md-4 border-md-left border-light">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-4">
                                                <label class="font-weight-bold text-dark">
                                                    <i class="fas fa-layer-group text-secondary mr-1"></i> Stok Buku <span
                                                        class="text-danger">*</span>
                                                </label>
                                                <input type="number" name="stok"
                                                    class="form-control form-control-lg text-sm @error('stok') is-invalid @enderror"
                                                    value="{{ old('stok', $buku->stok) }}" min="0" required>
                                                @error('stok')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-4">
                                                <label class="font-weight-bold text-dark">
                                                    <i class="fas fa-map-marker-alt text-secondary mr-1"></i> Lokasi Rak
                                                </label>
                                                <select name="rak"
                                                    class="form-control form-control-lg text-sm custom-select @error('rak') is-invalid @enderror">
                                                    <option value="">-- Pilih Rak --</option>
                                                    @foreach ($rak as $r)
                                                        <option value="{{ $r->nama_rak }}"
                                                            {{ old('rak', $buku->rak) == $r->nama_rak ? 'selected' : '' }}>
                                                            {{ $r->nama_rak }}</option>
                                                    @endforeach
                                                </select>
                                                @error('rak')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-4 bg-light p-3 rounded border">
                                        <label class="font-weight-bold text-dark mb-2">
                                            <i class="fas fa-image text-secondary mr-1"></i> Ganti Cover Buku <small
                                                class="text-muted font-weight-normal">(Opsional)</small>
                                        </label>
                                        <input type="file" name="cover"
                                            class="form-control-file @error('cover') is-invalid @enderror"
                                            accept="image/*">
                                        @if ($buku->cover)
                                            <div class="mt-2 text-success small font-weight-medium">
                                                <i class="fas fa-check-circle mr-1"></i> Buku ini sudah memiliki cover.
                                            </div>
                                        @endif
                                        @error('cover')
                                            <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-4 bg-light p-3 rounded border">
                                        <label class="font-weight-bold text-dark mb-2">
                                            <i class="fas fa-file-pdf text-secondary mr-1"></i> Ganti File E-Book <small
                                                class="text-muted font-weight-normal">(Opsional)</small>
                                        </label>
                                        <input type="file" name="file_ebook"
                                            class="form-control-file @error('file_ebook') is-invalid @enderror"
                                            accept="application/pdf">
                                        @if ($buku->file_ebook)
                                            <div class="mt-2 text-success small font-weight-medium">
                                                <i class="fas fa-check-circle mr-1"></i> File E-Book tersedia.
                                            </div>
                                        @endif
                                        @error('file_ebook')
                                            <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-0">
                                        <label class="font-weight-bold text-dark">
                                            <i class="fas fa-align-left text-secondary mr-1"></i> Sinopsis / Deskripsi
                                        </label>
                                        <textarea name="deskripsi" rows="5" class="form-control text-sm @error('deskripsi') is-invalid @enderror"
                                            placeholder="Tuliskan deskripsi atau sinopsis singkat buku ini...">{{ old('deskripsi', $buku->deskripsi) }}</textarea>
                                        @error('deskripsi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-light border-top text-right py-3 px-4">
                            <a href="{{ route('admin.buku.index') }}"
                                class="btn btn-secondary px-4 mr-2 shadow-sm font-weight-bold">
                                <i class="fas fa-arrow-left mr-1"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary px-4 font-weight-bold shadow-sm">
                                <i class="fas fa-save mr-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection

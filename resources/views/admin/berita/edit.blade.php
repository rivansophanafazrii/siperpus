@extends('layouts.master')

@section('title', 'Edit Berita - SIPERPUS')

@push('styles')
@endpush

@section('content')
    <div class="content-wrapper bg-light">
        <!-- Content Header -->
        <div class="content-header pt-4 pb-3">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h3 class="m-0 font-weight-bold text-dark">Edit Publikasi</h3>
                        <p class="text-muted small mb-0">Perbarui konten artikel atau pengumuman Anda.</p>
                    </div>
                    <div class="col-sm-6 text-sm-right mt-2 mt-sm-0">
                        <ol class="breadcrumb float-sm-right bg-transparent p-0 m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"
                                    class="text-primary">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.berita.index') }}"
                                    class="text-primary">Data Berita</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                {{-- Notifikasi Error Validasi --}}
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0" role="alert">
                        <strong><i class="fas fa-exclamation-triangle mr-2"></i> Pengubahan Gagal!</strong>
                        <ul class="mb-0 mt-1 pl-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="card border-0 shadow-sm rounded-lg mb-5">
                    <div class="card-header bg-white py-3 border-0">
                        <h5 class="font-weight-bold text-dark mb-0">
                            <i class="fas fa-edit text-warning mr-2"></i>Form Pembaruan Berita
                        </h5>
                    </div>

                    <form action="{{ route('admin.berita.update', $berita->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="card-body bg-light border-top border-bottom p-4">
                            <div class="row">
                                <!-- Kolom Kiri -->
                                <div class="col-md-8 mb-3 mb-md-0">
                                    <div class="bg-white p-4 rounded shadow-sm h-100 border">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Judul Berita <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="judul"
                                                class="form-control form-control-lg @error('judul') is-invalid @enderror"
                                                value="{{ old('judul', $berita->judul) }}" required>
                                        </div>

                                        <div class="form-group mb-0">
                                            <label class="font-weight-bold">Isi Konten <span
                                                    class="text-danger">*</span></label>
                                            <textarea name="konten" id="summernote" class="form-control @error('konten') is-invalid @enderror" required>{{ old('konten', $berita->konten) }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <!-- Kolom Kanan -->
                                <div class="col-md-4">
                                    <div class="bg-white p-4 rounded shadow-sm border">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Kategori <span
                                                    class="text-danger">*</span></label>
                                            <select name="kategori"
                                                class="form-control custom-select @error('kategori') is-invalid @enderror"
                                                required>
                                                <option value="Pengumuman"
                                                    {{ old('kategori', $berita->kategori) == 'Pengumuman' ? 'selected' : '' }}>
                                                    Pengumuman</option>
                                                <option value="Artikel Literasi"
                                                    {{ old('kategori', $berita->kategori) == 'Artikel Literasi' ? 'selected' : '' }}>
                                                    Artikel Literasi</option>
                                                <option value="Info Kegiatan"
                                                    {{ old('kategori', $berita->kategori) == 'Info Kegiatan' ? 'selected' : '' }}>
                                                    Info Kegiatan</option>
                                                <option value="Olahraga"
                                                    {{ old('kategori', $berita->kategori) == 'Olahraga' ? 'selected' : '' }}>
                                                    Olahraga</option>
                                                <option value="Prestasi"
                                                    {{ old('kategori', $berita->kategori) == 'Prestasi' ? 'selected' : '' }}>
                                                    Prestasi</option>
                                                <option value="Jurnal"
                                                    {{ old('kategori', $berita->kategori) == 'Jurnal' ? 'selected' : '' }}>
                                                    Jurnal</option>
                                                <option value="Ekstrakurikuler"
                                                    {{ old('kategori', $berita->kategori) == 'Ekstrakurikuler' ? 'selected' : '' }}>
                                                    Ekstrakurikuler</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label class="font-weight-bold">Status Tayang <span
                                                    class="text-danger">*</span></label>
                                            <select name="is_published"
                                                class="form-control custom-select @error('is_published') is-invalid @enderror"
                                                required>
                                                <option value="1"
                                                    {{ old('is_published', $berita->is_published) == '1' ? 'selected' : '' }}>
                                                    Langsung Tayang (Publish)</option>
                                                <option value="0"
                                                    {{ old('is_published', $berita->is_published) == '0' ? 'selected' : '' }}>
                                                    Simpan Sebagai Draft</option>
                                            </select>
                                        </div>

                                        <div class="form-group mb-0">
                                            <label class="font-weight-bold">Gambar Cover Baru</label>
                                            <div class="custom-file mb-2">
                                                <input type="file" name="gambar"
                                                    class="custom-file-input @error('gambar') is-invalid @enderror"
                                                    id="customFile" accept="image/*" onchange="previewImage(event)">
                                                <label class="custom-file-label text-truncate" for="customFile">Biarkan
                                                    kosong jika tetap...</label>
                                            </div>

                                            <div class="bg-light p-2 rounded border mt-2 text-center">
                                                <small class="text-muted d-block mb-2 font-weight-bold">Preview / Gambar
                                                    Saat Ini</small>
                                                <img id="preview"
                                                    src="{{ $berita->gambar ? asset('storage/' . $berita->gambar) : '#' }}"
                                                    alt="Preview Gambar" class="img-fluid rounded border shadow-sm"
                                                    style="max-height: 180px; object-fit: cover; width: 100%; {{ !$berita->gambar ? 'display:none;' : '' }}">

                                                @if (!$berita->gambar)
                                                    <span id="preview-text" class="text-muted small py-3 d-block"><i
                                                            class="fas fa-image fa-2x mb-2 text-black-50 d-block"></i>Belum
                                                        ada gambar</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer bg-white text-right py-3">
                            <a href="{{ route('admin.berita.index') }}" class="btn btn-light border mr-2 font-weight-bold">
                                <i class="fas fa-times mr-1"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-warning text-white font-weight-bold px-4 shadow-sm">
                                <i class="fas fa-save mr-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 350,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });

        function previewImage(event) {
            var input = event.target;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                var fileName = input.files[0].name;

                $(input).next('.custom-file-label').html(fileName);

                reader.onload = function(e) {
                    var output = document.getElementById('preview');
                    var text = document.getElementById('preview-text');

                    output.src = e.target.result;
                    output.style.display = 'block';
                    if (text) text.style.display = 'none';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush

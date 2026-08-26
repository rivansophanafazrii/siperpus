@extends('layouts.master')

@section('title', 'Tambah Berita - SIPERPUS')

@section('content')
    <div class="content-wrapper bg-light">
        <!-- Content Header -->
        <div class="content-header pt-4 pb-3">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h3 class="m-0 font-weight-bold text-dark">Tambah Publikasi Baru</h3>
                        <p class="text-muted small mb-0">Tulis artikel, pengumuman, atau berita baru.</p>
                    </div>
                    <div class="col-sm-6 text-sm-right mt-2 mt-sm-0">
                        <ol class="breadcrumb float-sm-right bg-transparent p-0 m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"
                                    class="text-primary">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.berita.index') }}"
                                    class="text-primary">Data Berita</a></li>
                            <li class="breadcrumb-item active">Tambah</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card border-0 shadow-sm rounded-lg mb-5">
                    <div class="card-header bg-white py-3 border-0">
                        <h5 class="font-weight-bold text-dark mb-0">
                            <i class="fas fa-pen-nib text-primary mr-2"></i>Form Penulisan Berita
                        </h5>
                    </div>

                    <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body bg-light border-top border-bottom p-4">
                            <div class="row">
                                <!-- Kolom Kiri: Info Utama -->
                                <div class="col-md-8 mb-3 mb-md-0">
                                    <div class="bg-white p-4 rounded shadow-sm h-100 border">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Judul Berita <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="judul"
                                                class="form-control form-control-lg @error('judul') is-invalid @enderror"
                                                value="{{ old('judul') }}" placeholder="Masukkan judul..." required>
                                            @error('judul')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-0">
                                            <label class="font-weight-bold">Isi Konten <span
                                                    class="text-danger">*</span></label>
                                            <textarea name="konten" id="summernote" class="form-control @error('konten') is-invalid @enderror" required>{{ old('konten') }}</textarea>
                                            @error('konten')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Kolom Kanan: Pengaturan & Gambar -->
                                <div class="col-md-4">
                                    <div class="bg-white p-4 rounded shadow-sm border">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Kategori <span
                                                    class="text-danger">*</span></label>
                                            <select name="kategori"
                                                class="form-control custom-select @error('kategori') is-invalid @enderror"
                                                required>
                                                <option value="">-- Pilih Kategori --</option>
                                                <option value="Pengumuman"
                                                    {{ old('kategori') == 'Pengumuman' ? 'selected' : '' }}>Pengumuman
                                                </option>
                                                <option value="Artikel Literasi"
                                                    {{ old('kategori') == 'Artikel Literasi' ? 'selected' : '' }}>Artikel
                                                    Literasi</option>
                                                <option value="Info Kegiatan"
                                                    {{ old('kategori') == 'Info Kegiatan' ? 'selected' : '' }}>Info Kegiatan
                                                </option>
                                                <option value="Olahraga"
                                                    {{ old('kategori') == 'Olahraga' ? 'selected' : '' }}>Olahraga</option>
                                                <option value="Prestasi"
                                                    {{ old('kategori') == 'Prestasi' ? 'selected' : '' }}>Prestasi</option>
                                                <option value="Jurnal" {{ old('kategori') == 'Jurnal' ? 'selected' : '' }}>
                                                    Jurnal</option>
                                                <option value="Ekstrakurikuler"
                                                    {{ old('kategori') == 'Ekstrakurikuler' ? 'selected' : '' }}>
                                                    Ekstrakurikuler</option>
                                            </select>
                                            @error('kategori')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="font-weight-bold">Status Tayang <span
                                                    class="text-danger">*</span></label>
                                            <select name="is_published"
                                                class="form-control custom-select @error('is_published') is-invalid @enderror"
                                                required>
                                                <option value="1" {{ old('is_published') == '1' ? 'selected' : '' }}>
                                                    Langsung Tayang (Publish)</option>
                                                <option value="0" {{ old('is_published') == '0' ? 'selected' : '' }}>
                                                    Simpan Sebagai Draft</option>
                                            </select>
                                        </div>

                                        <div class="form-group mb-0">
                                            <label class="font-weight-bold">Gambar Cover <small
                                                    class="text-muted">(Opsional)</small></label>
                                            <div class="custom-file mb-2">
                                                <input type="file" name="gambar"
                                                    class="custom-file-input @error('gambar') is-invalid @enderror"
                                                    id="customFile" accept="image/*" onchange="previewImage(event)">
                                                <label class="custom-file-label text-truncate" for="customFile">Pilih
                                                    gambar...</label>
                                            </div>
                                            <div class="text-center bg-light rounded border p-2 mt-2">
                                                <img id="preview" src="#" alt="Preview" class="img-fluid rounded"
                                                    style="display: none; max-height: 180px; object-fit: cover; width: 100%;">
                                                <span id="preview-text" class="text-muted small d-block py-4"><i
                                                        class="fas fa-image fa-2x mb-2 text-black-50 d-block"></i>Preview
                                                    Gambar</span>
                                            </div>
                                            @error('gambar')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                            <small class="text-muted d-block mt-2"><i
                                                    class="fas fa-info-circle mr-1"></i>Format: JPG/PNG, Maks: 5MB.</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer bg-white text-right py-3">
                            <a href="{{ route('admin.berita.index') }}" class="btn btn-light border mr-2 font-weight-bold">
                                <i class="fas fa-times mr-1"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary font-weight-bold px-4 shadow-sm">
                                <i class="fas fa-paper-plane mr-1"></i> Terbitkan Publikasi
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
                placeholder: 'Tuliskan isi berita, pengumuman, atau artikel literasi di sini...',
                tabsize: 2,
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
            var reader = new FileReader();
            var fileName = input.files[0].name;

            $(input).next('.custom-file-label').html(fileName);

            reader.onload = function() {
                var dataURL = reader.result;
                var output = document.getElementById('preview');
                var text = document.getElementById('preview-text');

                output.src = dataURL;
                output.style.display = 'block';
                text.style.display = 'none';
            };
            reader.readAsDataURL(input.files[0]);
        }
    </script>
@endpush

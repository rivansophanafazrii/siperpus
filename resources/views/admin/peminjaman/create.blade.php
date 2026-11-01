@extends('layouts.master')

@section('title', 'Pinjam Buku - SIPERPUS')

@section('content')
    <style>
        /* CSS untuk Form Fokus */
        .form-control:focus {
            background-color: #fff !important;
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }

        /* CSS Custom untuk Kotak Pencarian */
        .live-search-wrapper {
            position: relative;
        }

        .live-search-list {
            position: absolute;
            z-index: 1050;
            width: 100%;
            max-height: 250px;
            overflow-y: auto;
            background-color: #ffffff;
            border: 1px solid #ced4da;
            border-radius: 0.5rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, .15);
            display: none;
            margin-top: 5px;
        }

        .live-search-item {
            padding: 12px 15px;
            cursor: pointer;
            border-bottom: 1px solid #f8f9fa;
            color: #495057;
            font-size: 0.95rem;
            transition: all 0.2s ease-in-out;
        }

        .live-search-item:last-child {
            border-bottom: none;
        }

        .live-search-item:hover {
            background-color: #f1f5f9;
            color: #0d6efd;
            padding-left: 20px;
            /* Efek indent saat dihover */
        }

        .live-search-item strong {
            color: #0d6efd;
        }

        /* Scrollbar kustom untuk list pencarian */
        .live-search-list::-webkit-scrollbar {
            width: 6px;
        }

        .live-search-list::-webkit-scrollbar-thumb {
            background-color: #adb5bd;
            border-radius: 10px;
        }
    </style>

    <!-- Script PHP untuk mempertahankan data jika ada error validasi -->
    @php
        $oldUserText = '';
        if (old('user_id')) {
            foreach ($users as $u) {
                if ($u->id == old('user_id')) {
                    $oldUserText = ($u->nis_nip ?? $u->username) . ' - ' . $u->name;
                    break;
                }
            }
        }

        $oldBukuText = '';
        if (old('buku_id')) {
            foreach ($buku as $b) {
                if ($b->id == old('buku_id')) {
                    $oldBukuText = $b->kode_buku . ' - ' . $b->judul;
                    break;
                }
            }
        }
    @endphp

    <div class="content-wrapper bg-light">
        <!-- Content Header -->
        <div class="content-header pt-4 pb-3">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h3 class="m-0 font-weight-bold text-dark">Form Peminjaman Baru</h3>
                        <p class="text-muted small mb-0">Catat transaksi peminjaman buku perpustakaan.</p>
                    </div>
                    <div class="col-sm-6 text-sm-right mt-2 mt-sm-0">
                        <ol class="breadcrumb float-sm-right bg-transparent p-0 m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"
                                    class="text-primary text-decoration-none">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.peminjaman.index') }}"
                                    class="text-primary text-decoration-none">Data Peminjaman</a></li>
                            <li class="breadcrumb-item active">Pinjam Buku</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-7 mb-4">
                        <div class="card border-0 shadow-sm rounded-lg mb-5">
                            <div class="card-header bg-white py-3 border-0">
                                <h5 class="font-weight-bold text-dark mb-0">
                                    <i class="fas fa-edit text-primary mr-2"></i>Detail Peminjaman
                                </h5>
                            </div>

                            <form action="{{ route('admin.peminjaman.store') }}" method="POST">
                                @csrf
                                <div class="card-body bg-white pt-2 pb-4">

                                    @if (session('error'))
                                        <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0"
                                            role="alert">
                                            <i class="fas fa-exclamation-triangle mr-2"></i> {{ session('error') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif

                                    <!-- Panel Informasi -->
                                    <div class="alert alert-info border-0 shadow-sm d-flex align-items-center mb-4 p-3 rounded"
                                        style="background-color: #e6f7ff; color: #0056b3;">
                                        <i class="fas fa-info-circle fa-2x mr-3"></i>
                                        <div class="small">
                                            <strong>Panduan Peminjaman:</strong><br>
                                            Pastikan anggota yang dipilih berstatus aktif dan buku yang dipinjam masih
                                            memiliki stok. Maksimal peminjaman default adalah 7 hari.
                                        </div>
                                    </div>

                                    <!-- Pencarian Anggota -->
                                    <div class="form-group mb-4 live-search-wrapper">
                                        <label class="font-weight-bold text-dark">
                                            Cari Anggota <span class="text-danger">*</span>
                                        </label>

                                        <input type="hidden" name="user_id" id="hidden_user_id"
                                            value="{{ old('user_id') }}">

                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-light border-right-0"><i
                                                        class="fas fa-user text-muted"></i></span>
                                            </div>
                                            <input type="text" id="search_user"
                                                class="form-control bg-light border-left-0 @error('user_id') is-invalid @enderror"
                                                placeholder="Ketik nama atau NIS/NIP anggota..." value="{{ $oldUserText }}"
                                                autocomplete="off" required>
                                        </div>

                                        <!-- Daftar Pencarian Anggota -->
                                        <div class="live-search-list" id="list_user">
                                            @foreach ($users as $u)
                                                <div class="live-search-item item-user" data-id="{{ $u->id }}"
                                                    data-text="{{ $u->nis_nip ?? $u->username }} - {{ $u->name }}">
                                                    <i class="fas fa-id-card text-secondary mr-2"></i>
                                                    <strong>{{ $u->nis_nip ?? $u->username }}</strong> -
                                                    {{ $u->name }}
                                                </div>
                                            @endforeach
                                        </div>

                                        @error('user_id')
                                            <div class="invalid-feedback font-weight-bold d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Pencarian Buku -->
                                    <div class="form-group mb-4 live-search-wrapper">
                                        <label class="font-weight-bold text-dark">
                                            Cari Buku <span class="text-danger">*</span>
                                        </label>

                                        <input type="hidden" name="buku_id" id="hidden_buku_id"
                                            value="{{ old('buku_id') }}">

                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-light border-right-0"><i
                                                        class="fas fa-book text-muted"></i></span>
                                            </div>
                                            <input type="text" id="search_buku"
                                                class="form-control bg-light border-left-0 @error('buku_id') is-invalid @enderror"
                                                placeholder="Ketik judul atau kode buku..." value="{{ $oldBukuText }}"
                                                autocomplete="off" required>
                                        </div>

                                        <!-- Daftar Pencarian Buku -->
                                        <div class="live-search-list" id="list_buku">
                                            @foreach ($buku as $b)
                                                <div class="live-search-item item-buku" data-id="{{ $b->id }}"
                                                    data-text="{{ $b->kode_buku }} - {{ $b->judul }}">
                                                    <i class="fas fa-barcode text-secondary mr-2"></i>
                                                    <strong>{{ $b->kode_buku }}</strong> - {{ $b->judul }}
                                                    <span
                                                        class="badge {{ $b->stok > 0 ? 'badge-success' : 'badge-danger' }} ml-2 float-right">
                                                        Stok: {{ $b->stok }}
                                                    </span>
                                                </div>
                                            @endforeach
                                        </div>

                                        @error('buku_id')
                                            <div class="invalid-feedback font-weight-bold d-block">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Lama Pinjam -->
                                    <div class="form-group mb-2">
                                        <label class="font-weight-bold text-dark">
                                            Lama Pinjam <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group"
                                            style="border-radius: 0.35rem; overflow: hidden; width: 50%;">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-light border-right-0">
                                                    <i class="fas fa-clock text-muted"></i>
                                                </span>
                                            </div>

                                            <!-- Tambahkan atribut list="opsi_durasi" pada input -->
                                            <input type="number" name="lama_pinjam" list="opsi_durasi"
                                                class="form-control bg-light border-left-0 border-right-0 @error('lama_pinjam') is-invalid @enderror"
                                                value="{{ old('lama_pinjam', 7) }}" min="1" max="1000"
                                                required placeholder="Ketik atau pilih...">

                                            <!-- Datalist untuk memunculkan opsi dropdown -->
                                            <datalist id="opsi_durasi">
                                                <option value="7">1 Minggu (7 Hari)</option>
                                                <option value="30">1 Bulan (30 Hari)</option>
                                                <option value="365">1 Tahun (365 Hari)</option>
                                            </datalist>

                                            <div class="input-group-append">
                                                <span
                                                    class="input-group-text bg-light text-muted border-left-0 font-weight-bold">Hari</span>
                                            </div>
                                        </div>

                                        @error('lama_pinjam')
                                            <div class="invalid-feedback font-weight-bold d-block">{{ $message }}</div>
                                        @enderror

                                        <small class="text-muted mt-2 d-block">
                                            <i class="fas fa-asterisk text-warning mr-1" style="font-size: 10px;"></i>
                                            Pilih durasi dari daftar atau ketik jumlah hari secara manual.
                                        </small>
                                    </div>

                                </div>

                                <div class="card-footer bg-light border-top text-right py-3 px-4">
                                    <a href="{{ route('admin.peminjaman.index') }}"
                                        class="btn btn-light border btn-sm px-4 mr-2 shadow-sm font-weight-bold">
                                        <i class="fas fa-times mr-1"></i> Batal
                                    </a>
                                    <button type="submit" class="btn btn-primary btn-sm px-4 font-weight-bold shadow-sm">
                                        <i class="fas fa-save mr-1"></i> Simpan Peminjaman
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Script JavaScript Manual untuk Fungsi Live Search -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function setupLiveSearch(inputId, hiddenId, listId, itemClass) {
                const input = document.querySelector(inputId);
                const hidden = document.querySelector(hiddenId);
                const list = document.querySelector(listId);
                const items = document.querySelectorAll(itemClass);

                // Tampilkan list pencarian saat diklik
                input.addEventListener('focus', function() {
                    list.style.display = 'block';
                });

                // Filter data saat user mengetik
                input.addEventListener('keyup', function() {
                    let filter = this.value.toLowerCase();
                    list.style.display = 'block';

                    // Jika dihapus, hapus juga ID aslinya
                    if (filter === '') {
                        hidden.value = '';
                    }

                    items.forEach(function(item) {
                        let text = item.getAttribute('data-text').toLowerCase();
                        if (text.indexOf(filter) > -1) {
                            item.style.display = '';
                        } else {
                            item.style.display = 'none';
                        }
                    });
                });

                // Memasukkan data saat salah satu item dipilih
                items.forEach(function(item) {
                    item.addEventListener('click', function() {
                        input.value = this.getAttribute('data-text'); // Tampilkan nama
                        hidden.value = this.getAttribute('data-id'); // Simpan ID untuk dikirim
                        list.style.display = 'none'; // Sembunyikan list
                    });
                });

                // Menutup list jika user klik di sembarang tempat di luar kotak
                document.addEventListener('click', function(e) {
                    if (!input.contains(e.target) && !list.contains(e.target)) {
                        list.style.display = 'none';
                    }
                });
            }

            // Jalankan fungsi untuk kedua kolom pencarian
            setupLiveSearch('#search_user', '#hidden_user_id', '#list_user', '.item-user');
            setupLiveSearch('#search_buku', '#hidden_buku_id', '#list_buku', '.item-buku');
        });
    </script>
@endsection

@extends('layouts.front') {{-- Sesuaikan dengan nama file layout utama Anda --}}

@section('content')
    <style>
        /* Penyesuaian Halaman Statis Selaras dengan Landing Page */
        .page-hero-container {
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.92), rgba(37, 99, 235, 0.85)), url('https://images.unsplash.com/photo-1521587760476-6c12a4b040da?auto=format&fit=crop&w=1920&q=80') center/cover no-repeat;
            padding: 8rem 0 7rem 0;
            border-radius: 0 0 48px 48px;
            margin-bottom: 2rem;
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.15);
        }

        .page-title {
            color: #ffffff;
            font-weight: 800;
            letter-spacing: -0.75px;
        }

        .page-subtitle {
            color: rgba(255, 255, 255, 0.85);
            font-size: 1.1rem;
            max-width: 650px;
            line-height: 1.7;
        }

        .page-icon-box-hero {
            width: 85px;
            height: 85px;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            color: #ffffff;
            border-radius: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.2rem;
            margin: 0 auto 1.5rem auto;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Styling Kotak Pencarian Melayang - Dirampingkan seperti Landing Page */
        .search-box-wrapper {
            max-width: 600px;
            background: #ffffff;
            padding: 5px 6px;
            /* Padding dipangkas drastis agar tidak tinggi */
            border-radius: 50px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(226, 232, 240, 0.8);
            margin: 0 auto;
        }

        .search-box-wrapper input {
            border: none;
            box-shadow: none !important;
            padding-left: 15px;
            font-size: 0.9rem;
            /* Ukuran teks disesuaikan */
            height: 40px;
            /* Tinggi input dibatasi */
        }

        .search-box-wrapper .btn-search {
            border-radius: 50px;
            padding: 8px 28px;
            /* Padding atas-bawah tombol dikurangi */
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            /* Membuat teks jadi kapital seperti di landing page */
            letter-spacing: 0.5px;
        }

        /* Styling Grid Buku */
        .book-card {
            transition: all 0.3s ease;
            border: 1px solid rgba(226, 232, 240, 0.8);
        }

        .book-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1) !important;
        }

        .book-cover-wrapper {
            position: relative;
            padding: 15px 15px 0 15px;
            background-color: transparent;
            text-align: center;
        }

        .book-cover {
            width: 100%;
            display: block;
            height: 250px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
            transition: 0.3s ease;
        }

        .status-badge {
            position: absolute;
            top: 25px;
            right: 25px;
            padding: 6px 12px;
            font-size: 0.8rem;
            font-weight: 600;
            border-radius: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            z-index: 2;
        }
    </style>

    <!-- Pahlawan Visual (Hero Section) -->
    <section class="page-hero-container bg-grid-pattern">
        <div class="container text-center">
            <!-- Ikon Halaman -->
            <div class="page-icon-box-hero shadow-sm mb-4 floating-element">
                <i class="fa-solid fa-book-open"></i>
            </div>

            <!-- Judul & Deskripsi -->
            <h1 class="display-5 page-title mb-3">Katalog Perpustakaan</h1>
            <p class="page-subtitle mx-auto">
                Temukan ribuan koleksi buku, jurnal, dan referensi akademik kami.
            </p>
        </div>
    </section>

    <!-- Area Konten Utama -->
    <div class="container pb-5" style="margin-top: -55px; position: relative; z-index: 10;">

        <!-- Form Pencarian Melayang -->
        <div class="search-box-wrapper mb-4 d-flex align-items-center">
            <form action="{{ route('opac.index') }}" method="GET" class="w-100 d-flex align-items-center">
                <!-- Simpan state filter jika ada -->
                @if (request('kategori'))
                    <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                @endif
                @if (request('sort'))
                    <input type="hidden" name="sort" value="{{ request('sort') }}">
                @endif

                <!-- TAMBAHAN: Simpan state jenis -->
                @if (request('jenis'))
                    <input type="hidden" name="jenis" value="{{ request('jenis') }}">
                @endif

                <i class="fas fa-search text-muted ml-3" style="font-size: 1rem;"></i>
                <input type="text" name="cari" class="form-control bg-transparent"
                    placeholder="Cari judul buku, penulis, atau penerbit..." value="{{ request('cari') }}">
                <button type="submit" class="btn btn-primary btn-search ml-2 shadow-sm">CARI</button>
            </form>
        </div>

        <!-- Baris Filter & Indikator Hasil -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 p-3 bg-white rounded-4 shadow-sm"
            style="border: 1px solid rgba(226, 232, 240, 0.8);">

            <div class="mb-3 mb-md-0 text-muted small">
                Menampilkan <strong>{{ $koleksiBuku->firstItem() ?? 0 }} - {{ $koleksiBuku->lastItem() ?? 0 }}</strong>
                dari total <strong>{{ $koleksiBuku->total() ?? 0 }}</strong> buku

                @if (request()->has('cari') && request('cari') != '')
                    untuk pencarian: <strong class="text-dark">"{{ request('cari') }}"</strong>
                    <a href="{{ route('opac.index') }}" class="text-danger ml-2 text-decoration-none">
                        <i class="fas fa-times"></i> Hapus
                    </a>
                @endif
            </div>

            <!-- Form Filter Tambahan -->
            <form action="{{ route('opac.index') }}" method="GET" class="d-flex flex-wrap gap-2">
                <!-- Simpan state pencarian jika ada -->
                @if (request('cari'))
                    <input type="hidden" name="cari" value="{{ request('cari') }}">
                @endif

                <!-- Filter Jenis Buku (Fisik / E-Book) -->
                <select name="jenis" class="form-select border-0 bg-light rounded-pill px-3 text-muted"
                    onchange="this.form.submit()" style="font-size: 0.85rem; cursor: pointer; width: auto;">
                    <option value="">Semua Jenis</option>
                    <option value="Fisik" {{ request('jenis') == 'Fisik' ? 'selected' : '' }}>Buku Fisik</option>
                    <option value="Ebook" {{ request('jenis') == 'Ebook' ? 'selected' : '' }}>E-Book</option>
                </select>

                <!-- Filter Kategori Dinamis -->
                <select name="kategori" class="form-select border-0 bg-light rounded-pill px-3 text-muted"
                    onchange="this.form.submit()" style="font-size: 0.85rem; cursor: pointer; width: auto;">
                    <option value="">Semua Kategori</option>
                    @foreach ($kategoriList as $kat)
                        <option value="{{ $kat->id }}" {{ request('kategori') == $kat->id ? 'selected' : '' }}>
                            {{ $kat->nama_kategori }}
                        </option>
                    @endforeach
                </select>

                <!-- Urutkan (Sorting) -->
                <select name="sort" class="form-select border-0 bg-light rounded-pill px-3 text-muted"
                    onchange="this.form.submit()" style="font-size: 0.85rem; cursor: pointer; width: auto;">
                    <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Buku Terbaru</option>
                    <option value="judul_asc" {{ request('sort') == 'judul_asc' ? 'selected' : '' }}>Judul (A - Z)</option>
                    <option value="judul_desc" {{ request('sort') == 'judul_desc' ? 'selected' : '' }}>Judul (Z - A)
                    </option>
                </select>
            </form>
        </div>

        <!-- Grid Buku -->
        <div class="row g-3">
            @forelse ($koleksiBuku as $buku)
                <!-- 6 Buku per baris di XL, 4 di LG, 3 di MD, 2 di Mobile -->
                <div class="col-xl-2 col-lg-3 col-md-4 col-6 mb-3">
                    <div class="card h-100 book-card rounded-4 bg-white position-relative">

                        <!-- Cover Buku & Badge Status -->
                        <div class="book-cover-wrapper rounded-top-4">
                            @if (isset($buku->stok) && $buku->stok > 0)
                                <span class="status-badge bg-success text-white">
                                    <i class="fas fa-check-circle me-1"></i> Tersedia
                                </span>
                            @else
                                <span class="status-badge bg-danger text-white">
                                    <i class="fas fa-clock me-1"></i> Dipinjam
                                </span>
                            @endif

                            @if ($buku->cover)
                                <img src="{{ asset('storage/' . $buku->cover) }}" class="book-cover mb-2"
                                    alt="{{ $buku->judul }}">
                            @else
                                <div class="book-cover mb-2 d-flex align-items-center justify-content-center bg-light text-muted"
                                    style="border: 1px dashed #cbd5e1;">
                                    <div class="text-center">
                                        <i class="fas fa-image fa-lg mb-1 text-secondary"></i>
                                        <br><small style="font-size: 0.7rem;" class="fw-bold">No Cover</small>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Informasi Buku -->
                        <div class="card-body d-flex flex-column p-3 pt-1">
                            <!-- Kategori -->
                            <div class="mb-2">
                                <span class="badge bg-primary bg-opacity-10 text-primary border-0 px-2 py-1 rounded-pill"
                                    style="font-size: 0.7rem; position: relative; z-index: 2;">
                                    {{ $buku->kategori->nama_kategori ?? 'Fiksi' }}
                                </span>
                            </div>

                            <!-- Judul -->
                            <h6 class="book-title fw-bold text-dark mb-1" title="{{ $buku->judul }}">
                                {{ $buku->judul }}
                            </h6>

                            <!-- Penulis -->
                            <p class="card-text text-muted mb-3" style="font-size: 0.75rem;">
                                <i class="fas fa-user-edit me-1"></i> {{ Str::limit($buku->penulis, 20) }}
                            </p>

                            <!-- Tombol Detail Ringkas -->
                            <a href="{{ route('opac.show', $buku->slug) }}"
                                class="btn btn-light btn-sm text-primary fw-bold rounded-pill mt-auto w-100 shadow-sm stretched-link"
                                style="border: 1px solid rgba(226, 232, 240, 0.8); font-size: 0.78rem;">
                                Detail <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>

                    </div>
                </div>
            @empty
                <!-- State Jika Buku Tidak Ditemukan -->
                <div class="col-12 text-center py-5">
                    <div class="p-4 bg-white rounded-4 shadow-sm mx-auto"
                        style="max-width: 500px; border: 1px solid rgba(226, 232, 240, 0.8);">
                        <i class="fas fa-search fa-3x text-muted mb-3"></i>
                        <h5 class="text-dark fw-bold mb-2">Buku Tidak Ditemukan</h5>
                        <p class="text-muted small mb-0">Maaf, kami tidak menemukan buku yang cocok dengan pencarian Anda.
                        </p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Paginasi -->
        <div class="d-flex justify-content-center mt-5">
            {{ $koleksiBuku->withQueryString()->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection

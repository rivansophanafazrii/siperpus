@extends('layouts.front')

@section('content')
    <!-- Tambahkan CSS Swiper langsung untuk halaman ini -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <style>
        /* Modifikasi Swiper & Card */
        .swiper-button-next,
        .swiper-button-prev {
            color: var(--color-primary) !important;
            background: rgba(255, 255, 255, 0.9);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .swiper-button-next:after,
        .swiper-button-prev:after {
            font-size: 18px !important;
            font-weight: bold;
        }

        .swiper-pagination-bullet-active {
            background: var(--color-primary) !important;
        }

        .book-card-link {
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .book-card-link:hover .card-title {
            color: var(--color-primary) !important;
        }

        /* Class baru untuk rasio cover buku proporsional */
        .book-cover-img {
            width: 100%;
            aspect-ratio: 3/4;
            /* Proporsi standar buku cetak */
            height: auto;
            object-fit: cover;
        }

        .book-cover-fallback {
            width: 100%;
            aspect-ratio: 3/4;
            height: auto;
            object-fit: contain;
            background-color: #f8f9fa;
        }
    </style>

    <section id="home" class="hero-container bg-grid-pattern">
        <!-- Elemen Abstrak Latar Belakang -->
        <div class="hero-blob blob-1"></div>
        <div class="hero-blob blob-2"></div>

        <div class="container position-relative" style="z-index: 2;">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <!-- Chip Dekoratif Mengapung -->
                    <div class="mb-3 floating-element">
                        <span class="glass-chip">
                            <i class="fa-solid fa-sparkles text-warning"></i> Sistem Informasi Perpustakaan
                        </span>
                    </div>

                    <h1 class="hero-title">{{ $profil->nama_perpustakaan }}</h1>
                    <p class="mb-4 mx-auto text-light opacity-85"
                        style="max-width: 620px; font-size: 1.05rem; line-height: 1.7;">
                        {{ $profil->deskripsi_hero ?? 'Infrastruktur digital untuk mengoptimalkan manajemen sirkulasi akademik dan memfasilitasi penelusuran referensi literatur komprehensif.' }}
                    </p>

                    <div class="d-flex flex-column flex-sm-row justify-content-center gap-3 mb-4">
                        <a href="{{ route('opac.index') }}" class="btn-modern-primary">JELAJAHI KOLEKSI</a>
                        <a href="/login" class="btn-modern-ghost">LOGIN</a>
                    </div>

                    <div class="search-module mx-auto">
                        <form action="/opac" method="GET" class="d-flex align-items-center gap-2">
                            <i class="fa-solid fa-magnifying-glass text-muted ms-2"></i>
                            <input type="text" name="cari" class="form-control search-input flex-grow-1"
                                placeholder="Cari Judul / Penulis / ISBN">
                            <button type="submit" class="btn-modern-primary py-2 px-4 shadow-sm"
                                style="border-radius: 50px; font-size: 0.9rem;">CARI</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Koleksi Pustaka (Dengan Slider) -->
    <section id="koleksi" class="section-padding">
        <div class="container position-relative">
            <div class="text-center mb-5 pb-lg-2">
                <span class="section-label">Pembaruan Pustaka</span>
                <h2 class="section-title">Koleksi Buku Terbaru</h2>
                <p class="text-muted fs-6">Inventaris referensi literatur akademik mutakhir.</p>
            </div>

            <!-- Swiper Container -->
            <div class="swiper bookSwiper pb-5 px-3">
                <div class="swiper-wrapper">
                    @forelse ($bukuTerbaru as $buku)
                        <div class="swiper-slide h-auto">
                            <!-- Link Dinamis ke Detail Buku -->
                            <a href="{{ route('opac.show', $buku->slug) }}" class="book-card-link h-100">
                                <div
                                    class="card h-100 border-0 shadow-sm rounded-4 text-center overflow-hidden transition-hover">
                                    @if ($buku->cover)
                                        <img src="{{ asset('storage/' . $buku->cover) }}"
                                            class="card-img-top book-cover-img" alt="{{ $buku->judul }}">
                                    @else
                                        <img src="{{ asset('images/no-cover.jpg') }}"
                                            class="card-img-top book-cover-fallback" alt="No Cover">
                                    @endif

                                    <div class="card-body d-flex flex-column justify-content-center p-3">
                                        <h6 class="card-title font-weight-bold text-dark mb-1 text-truncate transition-smooth"
                                            title="{{ $buku->judul }}">
                                            {{ $buku->judul }}
                                        </h6>
                                        <small class="card-text text-muted">{{ $buku->penulis }}</small>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="swiper-slide">
                            <div class="text-center text-muted py-5 w-100">
                                <p>Belum ada koleksi buku yang ditambahkan.</p>
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Navigasi & Pagination -->
                <div class="swiper-pagination book-pagination"></div>
                <div class="swiper-button-next book-next d-none d-md-flex"></div>
                <div class="swiper-button-prev book-prev d-none d-md-flex"></div>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('opac.index') }}" class="btn btn-outline-primary rounded-pill px-4 py-2 fw-bold">
                    <i class="fas fa-layer-group mr-2"></i> Lihat Semua Koleksi
                </a>
            </div>
        </div>
    </section>

    <!-- Metrik Sistem -->
    <section id="statistik-section" class="section-padding bg-white border-top border-bottom">
        <div class="container">
            <div class="text-center mb-5 pb-lg-2">
                <span class="section-label">Metrik Sistem</span>
                <h2 class="section-title">Statistik Operasional</h2>
                <p class="text-muted fs-6">Data kuantitatif sirkulasi perpustakaan secara waktu nyata.</p>
            </div>
            <div class="row g-4 text-center justify-content-center">
                <div class="col-12 col-md-4">
                    <div class="mb-3" style="color: var(--color-primary);"><i class="fa-solid fa-swatchbook fa-3x"></i>
                    </div>
                    <div class="stat-value">
                        <span class="counter-up" data-target="{{ $totalBuku ?? 15000 }}">0</span>+
                    </div>
                    <div class="stat-label">Koleksi Buku</div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="mb-3" style="color: var(--color-primary);"><i class="fa-solid fa-users fa-3x"></i></div>
                    <div class="stat-value">
                        <span class="counter-up" data-target="{{ $totalAnggota ?? 3500 }}">0</span>+
                    </div>
                    <div class="stat-label">Anggota Terdaftar</div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="mb-3" style="color: var(--color-primary);"><i
                            class="fa-solid fa-arrow-right-arrow-left fa-3x"></i></div>
                    <div class="stat-value">
                        <span class="counter-up" data-target="{{ $totalSirkulasi ?? 20000 }}">0</span>+
                    </div>
                    <div class="stat-label">Total Sirkulasi</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modul Layanan -->
    <section id="layanan" class="section-padding position-relative overflow-hidden">
        <div class="blob-section" style="top: 10%; left: -50px;"></div>
        <div class="container position-relative" style="z-index: 1;">
            <div class="text-center mb-5 pb-lg-2">
                <span class="section-label">Fasilitas Interaktif</span>
                <h2 class="section-title">Layanan Perpustakaan</h2>
                <p class="text-muted fs-6">Infrastruktur layanan untuk mendukung produktivitas pemustaka.</p>
            </div>
            <div class="row g-4">
                <div class="col-6 col-lg-3">
                    <a href="{{ route('layanan.sirkulasi') }}" class="text-decoration-none">
                        <div class="feature-card">
                            <div class="service-icon-box"><i class="fa-solid fa-right-left"></i></div>
                            <h6 class="fw-bold mb-0 text-dark">Sirkulasi</h6>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-lg-3">
                    <a href="{{ route('opac.index') }}" class="text-decoration-none">
                        <div class="feature-card">
                            <div class="service-icon-box"><i class="fa-solid fa-magnifying-glass"></i></div>
                            <h6 class="fw-bold mb-0 text-dark">OPAC</h6>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-lg-3">
                    <a href="{{ route('layanan.referensi') }}" class="text-decoration-none">
                        <div class="feature-card">
                            <div class="service-icon-box"><i class="fa-solid fa-book-bookmark"></i></div>
                            <h6 class="fw-bold mb-0 text-dark">Referensi</h6>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-lg-3">
                    <a href="{{ route('layanan.literasi') }}" class="text-decoration-none">
                        <div class="feature-card">
                            <div class="service-icon-box"><i class="fa-solid fa-graduation-cap"></i></div>
                            <h6 class="fw-bold mb-0 text-dark">Literasi</h6>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-lg-3">
                    <a href="{{ route('layanan.pojok-baca') }}" class="text-decoration-none">
                        <div class="feature-card">
                            <div class="service-icon-box"><i class="fa-solid fa-couch"></i></div>
                            <h6 class="fw-bold mb-0 text-dark">Pojok Baca</h6>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-lg-3">
                    <a href="{{ route('layanan.baca-ditempat') }}" class="text-decoration-none">
                        <div class="feature-card">
                            <div class="service-icon-box"><i class="fa-solid fa-chair"></i></div>
                            <h6 class="fw-bold mb-0 text-dark">Baca di Tempat</h6>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-lg-3">
                    <a href="{{ route('layanan.digital') }}" class="text-decoration-none">
                        <div class="feature-card">
                            <div class="service-icon-box"><i class="fa-solid fa-laptop-code"></i></div>
                            <h6 class="fw-bold mb-0 text-dark">Digital</h6>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-lg-3">
                    <a href="{{ route('layanan.info') }}" class="text-decoration-none">
                        <div class="feature-card">
                            <div class="service-icon-box"><i class="fa-solid fa-circle-info"></i></div>
                            <h6 class="fw-bold mb-0 text-dark">Info Layanan</h6>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Publikasi Berita (Dengan Slider) -->
    <section id="berita" class="section-padding bg-white border-top border-bottom">
        <div class="container position-relative">
            <div class="text-center mb-5 pb-lg-2">
                <span class="section-label">Publikasi Informasi</span>
                <h2 class="section-title">Berita Terkini</h2>
                <p class="text-muted fs-6">Laporan operasional dan pengumuman kegiatan akademik.</p>
            </div>

            <!-- Swiper Container Berita -->
            <div class="swiper newsSwiper pb-5 px-3">
                <div class="swiper-wrapper">
                    @forelse($beritaTerbaru as $item)
                        <div class="swiper-slide h-auto">
                            <div class="modern-card position-relative h-100 d-flex flex-column">

                                <!-- Label Kategori Clickable -->
                                <a href="{{ route('berita.kategori', $item->kategori) }}"
                                    class="card-badge text-decoration-none"
                                    style="position: absolute; z-index: 5; cursor: pointer;">
                                    {{ $item->kategori }}
                                </a>

                                <div class="card-img-wrapper">
                                    @if ($item->gambar)
                                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}"
                                            class="modern-card-img img-news">
                                    @else
                                        <img src="https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?auto=format&fit=crop&w=600&q=80"
                                            alt="Default Image" class="modern-card-img img-news">
                                    @endif
                                </div>

                                <div class="modern-card-body d-flex flex-column flex-grow-1">
                                    <div class="news-meta">
                                        <span><i class="fa-regular fa-calendar"></i>
                                            {{ $item->created_at->translatedFormat('d M Y') }}</span>
                                        <span><i class="fa-regular fa-clock ms-1"></i>
                                            {{ $item->created_at->format('H:i') }}</span>
                                    </div>
                                    <h5 class="modern-card-title">
                                        <a href="{{ route('berita.detail', $item->slug) }}"
                                            class="news-title-link line-clamp-2">
                                            {{ Str::limit($item->judul, 45) }}
                                        </a>
                                    </h5>
                                    <p class="modern-card-text line-clamp-3">
                                        {{ Str::limit(strip_tags($item->konten), 90) }}
                                    </p>
                                    <a href="{{ route('berita.detail', $item->slug) }}"
                                        class="btn-card-action mt-auto align-self-start">
                                        <i class="fa-solid fa-arrow-right"></i> Baca Selengkapnya
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="swiper-slide">
                            <div class="text-center py-4 w-100">
                                <p class="text-muted">Belum ada berita yang dipublikasikan.</p>
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Navigasi & Pagination untuk Berita -->
                <div class="swiper-pagination news-pagination"></div>
                <div class="swiper-button-next news-next d-none d-md-flex"></div>
                <div class="swiper-button-prev news-prev d-none d-md-flex"></div>
            </div>

            <div class="text-center mt-4">
                <a href="{{ url('/berita') }}" class="btn-modern-outline shadow-sm"><i
                        class="fa-regular fa-newspaper"></i> Lihat Semua Berita</a>
            </div>
        </div>
    </section>

    <!-- Instrumen Interaktif -->
    <section class="section-padding">
        <div class="container">
            <div class="text-center mb-5 pb-lg-2">
                <span class="section-label">Instrumen Evaluasi</span>
                <h2 class="section-title">Buku Tamu & Survei</h2>
                <p class="text-muted fs-6">Fasilitas pengumpulan data pengunjung dan usulan pengembangan.</p>
            </div>
            <div class="row g-4">
                <div class="col-12 col-lg-4">
                    <div class="feature-card text-center">
                        <div class="service-icon-box mx-auto"><i class="fa-solid fa-address-book"></i></div>
                        <h5 class="fw-bold mb-3">Buku Tamu Elektronik</h5>
                        <p class="text-muted mb-4">Pencatatan log absensi dan identifikasi kunjungan pemustaka harian.</p>
                        <a href="/buku-tamu" class="btn-card-action w-100 py-2 shadow-sm"><i
                                class="fa-solid fa-pen-to-square"></i> Isi Buku Tamu</a>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="feature-card text-center">
                        <div class="service-icon-box mx-auto"><i class="fa-solid fa-list-check"></i></div>
                        <h5 class="fw-bold mb-3">Survei Kebutuhan Pustaka</h5>
                        <p class="text-muted mb-4">Akuisisi usulan pengadaan koleksi literatur spesifik dari pengguna
                            aktif.</p>
                        <a href="{{ url('/survei-kebutuhan') }}" class="btn-card-action w-100 py-2 shadow-sm"><i
                                class="fa-solid fa-list-check"></i> Isi Survei</a>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="feature-card text-center">
                        <div class="service-icon-box mx-auto"><i class="fa-solid fa-star"></i></div>
                        <h5 class="fw-bold mb-3">Indeks Kepuasan Layanan</h5>
                        <p class="text-muted mb-4">Evaluasi empiris mutu operasional sirkulasi dan layanan perpustakaan.
                        </p>
                        <a href="/survei-kepuasan" class="btn-card-action w-100 py-2 shadow-sm"><i
                                class="fa-solid fa-star"></i> Isi Survei</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Library JS Swiper -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Script Counter & Inisialisasi Swiper -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // 1. Inisialisasi Swiper untuk Slider Buku Terbaru
            const bookSwiper = new Swiper('.bookSwiper', {
                slidesPerView: 1.2,
                spaceBetween: 12, // Diperkecil untuk layar mobile agar lebih rapat
                loop: true,
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.book-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.book-next',
                    prevEl: '.book-prev',
                },
                breakpoints: {
                    576: {
                        slidesPerView: 2.2,
                        spaceBetween: 16
                    },
                    768: {
                        slidesPerView: 3.2,
                        spaceBetween: 20
                    },
                    1024: {
                        slidesPerView: 4.2,
                        spaceBetween: 25
                    },
                }
            });

            // 2. Inisialisasi Swiper untuk Slider Berita Dinamis
            const newsSwiper = new Swiper('.newsSwiper', {
                slidesPerView: 1.1,
                spaceBetween: 12, // Diperkecil untuk layar mobile
                loop: true,
                rewind: true,
                observer: true,
                observeParents: true,
                watchOverflow: true,
                autoplay: {
                    delay: 4500,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.news-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.news-next',
                    prevEl: '.news-prev',
                },
                breakpoints: {
                    576: {
                        slidesPerView: 1.5,
                        spaceBetween: 16
                    },
                    768: {
                        slidesPerView: 2.2,
                        spaceBetween: 20
                    },
                    1024: {
                        slidesPerView: 3.2,
                        spaceBetween: 25
                    },
                    1200: {
                        slidesPerView: 3.5,
                        spaceBetween: 30
                    },
                }
            });

            // 3. Animasi Counter-Up
            const counters = document.querySelectorAll('.counter-up');
            const speed = 200;

            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const counter = entry.target;

                        const updateCount = () => {
                            const target = +counter.getAttribute('data-target');
                            const count = +counter.innerText;
                            const inc = target / speed;

                            if (count < target) {
                                counter.innerText = Math.ceil(count + inc);
                                setTimeout(updateCount, 15);
                            } else {
                                counter.innerText = target;
                            }
                        };

                        updateCount();
                        observer.unobserve(counter);
                    }
                });
            }, {
                threshold: 0.5
            });

            counters.forEach(counter => {
                observer.observe(counter);
            });
        });
    </script>
@endsection

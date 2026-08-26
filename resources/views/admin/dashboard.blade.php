@extends('layouts.master')

@section('title', 'Dashboard Admin - SIPERPUS')

@push('styles')
    <style>
        /* Kustomisasi Modern UI */
        .content-wrapper {
            background-color: #f4f6f9;
        }

        .card {
            border-radius: 12px;
            border: none;
            transition: transform 0.2s ease-in-out;
        }

        .card-header {
            border-top-left-radius: 12px !important;
            border-top-right-radius: 12px !important;
            background-color: #ffffff;
            border-bottom: 1px solid rgba(0, 0, 0, .05);
        }

        .small-box {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, .05);
        }

        .small-box .icon>i {
            font-size: 70px;
            opacity: 0.3;
            transition: transform 0.3s ease;
        }

        .small-box:hover .icon>i {
            transform: scale(1.1);
        }

        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
            cursor: pointer;
        }

        .badge-pill {
            padding: 0.4em 0.8em;
        }
    </style>
@endpush

@section('content')
    <!-- Penambahan Wrapper yang sebelumnya terlewat -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <div class="content-header pt-4 pb-2">
            <div class="container-fluid">
                <div class="row mb-2 align-items-center">
                    <div class="col-sm-6">
                        <h1 class="m-0 font-weight-bold text-dark">Dashboard Analitik</h1>
                        <p class="text-muted small mb-0">Ringkasan aktivitas dan statistik perpustakaan Anda.</p>
                    </div>
                    <div class="col-sm-6 text-sm-right mt-2 mt-sm-0">
                        <ol class="breadcrumb float-sm-right bg-transparent p-0 m-0">
                            <li class="breadcrumb-item"><a href="#" class="text-primary">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content pb-4">
            <div class="container-fluid">

                <!-- Welcome Message (Modern Alert) -->
                <div class="alert bg-white shadow-sm border-left-primary rounded-lg mb-4 p-4"
                    style="border-left: 5px solid #007bff;">
                    <button type="button" class="close text-muted" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5 class="font-weight-bold text-dark mb-1">
                        <i class="icon fas fa-hand-sparkles text-warning mr-2"></i> Selamat Datang,
                        {{ Auth::user()->name ?? 'Admin Perpustakaan' }}!
                    </h5>
                    <p class="text-muted mb-0" style="font-size: 0.95rem;">Semoga harimu menyenangkan. Berikut adalah
                        ringkasan sirkulasi, buku, dan anggota perpustakaan saat ini.</p>
                </div>

                <!-- ROW 1: Statistik Utama (Menggunakan Small Box Gradien) -->
                <div class="row">
                    <!-- Total Buku -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-gradient-info">
                            <div class="inner p-4">
                                <h3 class="mb-0">{{ number_format($total_buku ?? 0) }}</h3>
                                <p class="mb-0 font-weight-bold">Total Buku</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-book-open"></i>
                            </div>
                            <a href="{{ Route::has('admin.buku.index') ? route('admin.buku.index') : '#' }}"
                                class="small-box-footer py-2">
                                Kelola Katalog <i class="fas fa-arrow-circle-right ml-1"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Total Anggota -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-gradient-success">
                            <div class="inner p-4">
                                <h3 class="mb-0">{{ number_format($total_anggota ?? 0) }}</h3>
                                <p class="mb-0 font-weight-bold">Total Anggota</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <a href="{{ Route::has('admin.anggota.index') ? route('admin.anggota.index') : '#' }}"
                                class="small-box-footer py-2">
                                Kelola Anggota <i class="fas fa-arrow-circle-right ml-1"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Buku Dipinjam -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-gradient-warning">
                            <div class="inner p-4 text-white">
                                <h3 class="mb-0">{{ number_format($buku_dipinjam ?? 0) }}</h3>
                                <p class="mb-0 font-weight-bold">Sedang Dipinjam</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-hand-holding-heart"></i>
                            </div>
                            <a href="{{ Route::has('admin.peminjaman.index') ? route('admin.peminjaman.index') : '#' }}"
                                class="small-box-footer py-2" style="color: rgba(255,255,255,0.8) !important;">
                                Lihat Sirkulasi <i class="fas fa-arrow-circle-right ml-1"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Pendapatan Denda -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-gradient-danger">
                            <div class="inner p-4">
                                <!-- Menambahkan format Rupiah -->
                                <h3 class="mb-0">Rp {{ number_format($pendapatan_denda ?? 0, 0, ',', '.') }}</h3>
                                <p class="mb-0 font-weight-bold">Denda Bulan Ini</p>
                            </div>
                            <div class="icon">
                                <!-- Mengganti ikon menjadi ikon uang -->
                                <i class="fas fa-money-bill-wave"></i>
                            </div>
                            <a href="{{ Route::has('admin.peminjaman.index') ? route('admin.peminjaman.index') : '#' }}"
                                class="small-box-footer py-2">
                                Lihat Laporan <i class="fas fa-arrow-circle-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- ROW 2: Chart dan Sirkulasi Terakhir -->
                <div class="row">
                    <!-- Left col: Chart -->
                    <div class="col-lg-8 mb-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-header pt-3 pb-2">
                                <h3 class="card-title font-weight-bold text-dark">
                                    <i class="fas fa-chart-line text-primary mr-2"></i> Tren Peminjaman
                                    ({{ $tahun_ini ?? date('Y') }})
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="chart-container" style="position: relative; height:300px; width:100%">
                                    <canvas id="peminjamanChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right col: Sirkulasi Terakhir -->
                    <div class="col-lg-4 mb-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-header pt-3 pb-2 d-flex justify-content-between align-items-center">
                                <h3 class="card-title font-weight-bold text-dark">
                                    <i class="fas fa-sync-alt text-info mr-2"></i> Sirkulasi Terakhir
                                </h3>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive" style="max-height: 300px; overflow-y: auto;">
                                    <table class="table table-hover table-borderless table-striped m-0">
                                        <thead class="bg-light sticky-top">
                                            <tr>
                                                <th class="text-muted small">PEMINJAM</th>
                                                <th class="text-muted small text-right">STATUS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($transaksi_terbaru ?? [] as $trx)
                                                <tr>
                                                    <td class="align-middle py-3">
                                                        <strong
                                                            class="text-dark">{{ $trx->user->name ?? ($trx->user->nama ?? 'Anonim') }}</strong><br>
                                                        <small class="text-muted"><i class="fas fa-book mr-1"></i>
                                                            {{ Str::limit($trx->buku->judul ?? 'Buku Dihapus', 25) }}</small>
                                                    </td>
                                                    <td class="align-middle text-right">
                                                        @if ($trx->status == 'Dipinjam')
                                                            <span
                                                                class="badge badge-pill badge-warning px-3 py-1 text-white">Dipinjam</span>
                                                        @elseif($trx->status == 'Dikembalikan')
                                                            <span
                                                                class="badge badge-pill badge-success px-3 py-1">Kembali</span>
                                                        @else
                                                            <span
                                                                class="badge badge-pill badge-danger px-3 py-1">Terlambat</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="2" class="text-center text-muted py-5">
                                                        <i class="fas fa-inbox fa-2x mb-2 text-light"></i><br>
                                                        Belum ada sirkulasi terbaru.
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer bg-white border-top text-center py-3">
                                <a href="{{ Route::has('admin.peminjaman.index') ? route('admin.peminjaman.index') : '#' }}"
                                    class="text-primary font-weight-bold text-decoration-none">
                                    Lihat Semua Sirkulasi <i class="fas fa-angle-right ml-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ROW 3: Koleksi Buku Terbaru & Anggota Baru -->
                <div class="row">
                    <!-- Left col: Buku Terbaru -->
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-header pt-3 pb-2 d-flex justify-content-between align-items-center">
                                <h3 class="card-title font-weight-bold text-dark">
                                    <i class="fas fa-book-medical text-success mr-2"></i> Koleksi Buku Baru
                                </h3>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover align-items-center m-0">
                                        <tbody>
                                            @forelse($buku_terbaru ?? [] as $buku)
                                                @php
                                                    $gambar =
                                                        $buku->cover ??
                                                        ($buku->sampul ?? ($buku->gambar ?? ($buku->foto ?? null)));
                                                @endphp
                                                <tr>
                                                    <td class="align-middle py-3 px-4">
                                                        <div class="d-flex align-items-center">
                                                            @if ($gambar && file_exists(public_path('storage/' . $gambar)))
                                                                <img src="{{ asset('storage/' . $gambar) }}"
                                                                    alt="{{ $buku->judul }}"
                                                                    class="rounded shadow-sm mr-3"
                                                                    style="width: 45px; height: 60px; object-fit: cover; flex-shrink: 0;">
                                                            @elseif($gambar && filter_var($gambar, FILTER_VALIDATE_URL))
                                                                <img src="{{ $gambar }}" alt="{{ $buku->judul }}"
                                                                    class="rounded shadow-sm mr-3"
                                                                    style="width: 45px; height: 60px; object-fit: cover; flex-shrink: 0;">
                                                            @else
                                                                <div class="bg-light rounded d-flex align-items-center justify-content-center mr-3 border"
                                                                    style="width: 45px; height: 60px; flex-shrink: 0;">
                                                                    <i class="fas fa-book text-secondary"
                                                                        style="font-size: 1.5rem;"></i>
                                                                </div>
                                                            @endif
                                                            <div>
                                                                <strong
                                                                    class="text-dark d-block mb-1">{{ Str::limit($buku->judul, 40) }}</strong>
                                                                <span
                                                                    class="badge badge-light border text-muted mr-1">{{ $buku->kategori->nama_kategori ?? 'Umum' }}</span>
                                                                <small class="text-muted">{{ $buku->penulis ?? 'Anonim' }}
                                                                    • {{ $buku->tahun_terbit ?? '-' }}</small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td class="text-center text-muted py-5">Belum ada buku baru
                                                        ditambahkan.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer bg-white border-top text-center py-3">
                                <a href="{{ Route::has('admin.buku.index') ? route('admin.buku.index') : '#' }}"
                                    class="text-success font-weight-bold text-decoration-none">
                                    Kelola Katalog Buku <i class="fas fa-angle-right ml-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Right col: Anggota Baru -->
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-header pt-3 pb-2 d-flex justify-content-between align-items-center">
                                <h3 class="card-title font-weight-bold text-dark">
                                    <i class="fas fa-user-plus text-warning mr-2"></i> Anggota Baru Bergabung
                                </h3>
                            </div>
                            <div class="card-body p-0">
                                <ul class="list-group list-group-flush">
                                    @forelse($anggota_terbaru ?? [] as $anggota)
                                        <li
                                            class="list-group-item py-3 px-4 d-flex justify-content-between align-items-center">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-light text-primary font-weight-bold rounded-circle d-flex align-items-center justify-content-center mr-3 border"
                                                    style="width: 45px; height: 45px; font-size: 1.2rem;">
                                                    {{ strtoupper(substr($anggota->name ?? ($anggota->nama ?? 'U'), 0, 1)) }}
                                                </div>
                                                <div>
                                                    <strong
                                                        class="text-dark d-block">{{ $anggota->name ?? $anggota->nama }}</strong>
                                                    <small class="text-muted"><i class="far fa-clock mr-1"></i>
                                                        {{ \Carbon\Carbon::parse($anggota->created_at)->diffForHumans() }}</small>
                                                </div>
                                            </div>
                                            <span class="badge badge-pill badge-light border text-muted">Baru</span>
                                        </li>
                                    @empty
                                        <li class="list-group-item text-center text-muted py-5">Belum ada pendaftaran
                                            anggota baru.</li>
                                    @endforelse
                                </ul>
                            </div>
                            <div class="card-footer bg-white border-top text-center py-3">
                                <a href="{{ Route::has('admin.anggota.index') ? route('admin.anggota.index') : '#' }}"
                                    class="text-warning font-weight-bold text-decoration-none">
                                    Kelola Data Anggota <i class="fas fa-angle-right ml-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ctx = document.getElementById('peminjamanChart');
            if (ctx) {
                const chartContext = ctx.getContext('2d');
                const chartData = {!! json_encode($chart_data ?? [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]) !!};

                // Membuat efek gradasi pada Chart
                let gradient = chartContext.createLinearGradient(0, 0, 0, 400);
                gradient.addColorStop(0, 'rgba(0, 123, 255, 0.8)');
                gradient.addColorStop(1, 'rgba(0, 123, 255, 0.2)');

                new Chart(chartContext, {
                    type: 'bar',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt',
                            'Nov', 'Des'
                        ],
                        datasets: [{
                            label: 'Jumlah Peminjaman',
                            data: chartData,
                            backgroundColor: gradient,
                            borderColor: '#007bff',
                            borderWidth: 1,
                            borderRadius: 5,
                            hoverBackgroundColor: '#0056b3',
                            barPercentage: 0.6,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    precision: 0,
                                    color: '#6c757d'
                                },
                                grid: {
                                    borderDash: [5, 5],
                                    color: '#e9ecef'
                                }
                            },
                            x: {
                                ticks: {
                                    color: '#6c757d'
                                },
                                grid: {
                                    display: false
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                backgroundColor: 'rgba(0,0,0,0.8)',
                                padding: 12,
                                titleFont: {
                                    size: 14
                                },
                                bodyFont: {
                                    size: 13
                                },
                                displayColors: false,
                                callbacks: {
                                    label: function(context) {
                                        return context.parsed.y + ' Transaksi';
                                    }
                                }
                            }
                        }
                    }
                });
            }
        });
    </script>
@endpush

@extends('layouts.master')

@section('title', 'Dashboard Anggota - SIPERPUS')

@section('content')
    <div class="content-wrapper" style="background-color: #f8f9fa;">
        <!-- Content Header (Page header) -->
        <div class="content-header pt-4 pb-2">
            <div class="container-fluid">
                <div class="row mb-2 align-items-center">
                    <div class="col-sm-6">
                        <h1 class="m-0 font-weight-bold text-dark">Dashboard Analitik</h1>
                        <p class="text-muted small mb-0">Berikut adalah ringkasan aktivitas dan statistik perpustakaan
                            Anda.</p>
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

        <section class="content">
            <div class="container-fluid">
                <!-- Welcome Message (Modern Alert) -->
                <div class="alert bg-white shadow-sm border-left-primary rounded-lg mb-4 p-4"
                    style="border-left: 5px solid #007bff;">
                    <button type="button" class="close text-muted" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5 class="font-weight-bold text-dark mb-1">
                        <i class="icon fas fa-hand-sparkles text-warning mr-2"></i> Selamat Datang,
                        {{ Auth::user()->name ?? 'Anggota Perpustakaan' }}!
                    </h5>
                    <p class="text-muted mb-0" style="font-size: 0.95rem;">Semoga harimu menyenangkan. Berikut adalah ringkasan aktivitas dan status sirkulasi perpustakaan
                            Anda.</p>
                </div>

                <!-- Summary Cards SaaS Style -->
                <div class="row mb-4">
                    <!-- Sedang Dipinjam -->
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="card border-0 shadow-sm rounded-lg h-100">
                            <div class="card-body p-4 d-flex align-items-center justify-content-between">
                                <div>
                                    <span class="text-muted small font-weight-bold text-uppercase d-block mb-1">Sedang
                                        Dipinjam</span>
                                    <div class="h3 font-weight-bold text-dark mb-0">
                                        {{ $sedangDipinjam }} <span class="h6 text-muted font-weight-normal">Buku</span>
                                    </div>
                                </div>
                                <div class="rounded-circle d-flex align-items-center justify-content-center"
                                    style="width: 55px; height: 55px; background-color: #e7f0ff; color: #0d6efd;">
                                    <i class="fas fa-book-reader fa-lg"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Riwayat Selesai -->
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="card border-0 shadow-sm rounded-lg h-100">
                            <div class="card-body p-4 d-flex align-items-center justify-content-between">
                                <div>
                                    <span class="text-muted small font-weight-bold text-uppercase d-block mb-1">Riwayat
                                        Selesai</span>
                                    <div class="h3 font-weight-bold text-dark mb-0">
                                        {{ $riwayatSelesai }} <span class="h6 text-muted font-weight-normal">Buku</span>
                                    </div>
                                </div>
                                <div class="rounded-circle d-flex align-items-center justify-content-center"
                                    style="width: 55px; height: 55px; background-color: #e8f5e9; color: #28a745;">
                                    <i class="fas fa-history fa-lg"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Denda Belum Dibayar -->
                    <div class="col-lg-4 col-md-12 mb-3">
                        <div class="card border-0 shadow-sm rounded-lg h-100">
                            <div class="card-body p-4 d-flex align-items-center justify-content-between">
                                <div>
                                    <span class="text-muted small font-weight-bold text-uppercase d-block mb-1">Denda Belum
                                        Dibayar</span>
                                    <div class="h3 font-weight-bold text-dark mb-0">
                                        Rp {{ number_format($totalDenda, 0, ',', '.') }}
                                    </div>
                                </div>
                                <div class="rounded-circle d-flex align-items-center justify-content-center"
                                    style="width: 55px; height: 55px; background-color: #fde8e8; color: #dc3545;">
                                    <i class="fas fa-file-invoice-dollar fa-lg"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Grid Utama Dashboard -->
                <div class="row">
                    <!-- Kolom Kiri: Grafik & Peminjaman Aktif -->
                    <div class="col-lg-8 mb-4">

                        <!-- Grafik Aktivitas Peminjaman -->
                        <div class="card border-0 shadow-sm rounded-lg mb-4">
                            <div
                                class="card-header bg-white py-3 border-bottom-0 d-flex align-items-center justify-content-between">
                                <h6 class="font-weight-bold text-dark mb-0">
                                    <i class="fas fa-chart-line text-primary mr-2"></i> Grafik Aktivitas Peminjaman
                                </h6>
                                <span class="badge badge-light text-muted font-weight-normal px-2 py-1">6 Bulan
                                    Terakhir</span>
                            </div>
                            <div class="card-body">
                                <div style="height: 250px; position: relative;">
                                    <canvas id="peminjamanChart"></canvas>
                                </div>
                            </div>
                        </div>

                        <!-- Tabel Peminjaman Aktif -->
                        <div class="card border-0 shadow-sm rounded-lg">
                            <div
                                class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                                <h6 class="font-weight-bold text-dark mb-0">
                                    <i class="fas fa-list-ul text-primary mr-2"></i> Peminjaman Aktif Anda
                                </h6>
                                <a href="{{ route('anggota.peminjaman.index') }}"
                                    class="btn btn-sm btn-link text-primary p-0 font-weight-bold text-decoration-none">
                                    Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle mb-0 text-nowrap">
                                        <thead class="bg-white">
                                            <tr style="border-bottom: 2px solid #e9ecef;">
                                                <th
                                                    class="border-top-0 text-dark small text-uppercase font-weight-bold pl-4">
                                                    JUDUL BUKU</th>
                                                <th
                                                    class="border-top-0 text-dark small text-uppercase font-weight-bold text-center">
                                                    TGL PINJAM</th>
                                                <th
                                                    class="border-top-0 text-dark small text-uppercase font-weight-bold text-center">
                                                    TENGGAT KEMBALI</th>
                                                <th
                                                    class="border-top-0 text-dark small text-uppercase font-weight-bold text-center pr-4">
                                                    STATUS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($peminjamanAktif as $item)
                                                @php
                                                    $tenggat = \Carbon\Carbon::parse($item->tenggat_waktu);
                                                    $hariIni = \Carbon\Carbon::now()->startOfDay();
                                                    $selisih = $hariIni->diffInDays($tenggat, false);
                                                @endphp
                                                <tr style="border-bottom: 1px solid #e9ecef;">
                                                    <td class="align-middle pl-4">
                                                        <div class="font-weight-bold text-dark mb-1">
                                                            {{ $item->buku->judul ?? 'Judul Buku Tidak Ditemukan' }}
                                                        </div>
                                                        <small class="text-muted d-block">Penulis:
                                                            {{ $item->buku->penulis ?? '-' }}</small>
                                                    </td>
                                                    <td class="align-middle text-center small text-secondary">
                                                        {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->translatedFormat('d M Y') }}
                                                    </td>
                                                    <td
                                                        class="align-middle text-center small font-weight-bold {{ $selisih < 0 ? 'text-danger' : 'text-dark' }}">
                                                        {{ $tenggat->translatedFormat('d M Y') }}
                                                    </td>
                                                    <td class="align-middle text-center pr-4">
                                                        @if ($selisih < 0)
                                                            <span class="badge badge-danger px-2 py-1 rounded-pill"><i
                                                                    class="fas fa-exclamation-circle mr-1"></i> Terlambat
                                                                {{ abs($selisih) }} Hari</span>
                                                        @elseif ($selisih == 0)
                                                            <span
                                                                class="badge badge-warning text-dark px-2 py-1 rounded-pill"><i
                                                                    class="fas fa-clock mr-1"></i> Hari Ini</span>
                                                        @else
                                                            <span class="badge badge-info px-2 py-1 rounded-pill"><i
                                                                    class="fas fa-book-reader mr-1"></i> Dipinjam</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center py-5 text-muted border-0">
                                                        <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                                            style="width: 60px; height: 60px;">
                                                            <i class="fas fa-book-open fa-2x text-black-50"></i>
                                                        </div>
                                                        <p class="font-weight-medium mb-0">Anda tidak sedang meminjam buku
                                                            apapun saat ini.</p>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Kolom Kanan: Pintasan Cepat & Tips -->
                    <div class="col-lg-4 mb-4">
                        <!-- Pintasan Cepat -->
                        <div class="card border-0 shadow-sm rounded-lg mb-4">
                            <div class="card-header bg-white py-3 border-bottom">
                                <h6 class="font-weight-bold text-dark mb-0">
                                    <i class="fas fa-bolt text-warning mr-2"></i> Pintasan Cepat
                                </h6>
                            </div>
                            <div class="card-body p-2">
                                <div class="list-group list-group-flush">
                                    <a href="{{ url('/opac') }}"
                                        class="list-group-item list-group-item-action d-flex align-items-center border-0 rounded px-3 py-3 mb-1 hover-light">
                                        <div class="rounded-circle p-2 mr-3 d-flex align-items-center justify-content-center"
                                            style="width: 40px; height: 40px; background-color: #e7f0ff; color: #0d6efd;">
                                            <i class="fas fa-search"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="font-weight-bold text-dark style="font-size: 0.95rem;">Cari Buku
                                                (OPAC)</div>
                                            <small class="text-muted">Eksplorasi katalog koleksi buku</small>
                                        </div>
                                        <i class="fas fa-chevron-right text-muted small"></i>
                                    </a>

                                    <a href="{{ route('profile.index') }}"
                                        class="list-group-item list-group-item-action d-flex align-items-center border-0 rounded px-3 py-3 hover-light">
                                        <div class="rounded-circle p-2 mr-3 d-flex align-items-center justify-content-center"
                                            style="width: 40px; height: 40px; background-color: #e8f5e9; color: #28a745;">
                                            <i class="fas fa-user-edit"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="font-weight-bold text-dark style="font-size: 0.95rem;">Perbarui
                                                Profil Saya</div>
                                            <small class="text-muted">Kelola sandi & data akun</small>
                                        </div>
                                        <i class="fas fa-chevron-right text-muted small"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Card Himbauan / Informasi -->
                        <div class="card border-0 shadow-sm rounded-lg text-white"
                            style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="fas fa-info-circle fa-2x mr-3"></i>
                                    <h6 class="font-weight-bold mb-0">Aturan Pengembalian</h6>
                                </div>
                                <p class="small mb-0" style="opacity: 0.9; line-height: 1.6;">
                                    Harap mengembalikan buku tepat waktu sesuai tenggat tanggal pinjam untuk menghindari
                                    denda keterlambatan sirkulasi.
                                </p>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </section>
    </div>

    <!-- Script Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ctx = document.getElementById('peminjamanChart').getContext('2d');

            // Gradient fill untuk area grafik
            const gradient = ctx.createLinearGradient(0, 0, 0, 200);
            gradient.addColorStop(0, 'rgba(13, 110, 253, 0.25)');
            gradient.addColorStop(1, 'rgba(13, 110, 253, 0.0)');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($chartLabels),
                    datasets: [{
                        label: 'Jumlah Buku Dipinjam',
                        data: @json($chartData),
                        borderColor: '#0d6efd',
                        borderWidth: 3,
                        backgroundColor: gradient,
                        fill: true,
                        tension: 0.35,
                        pointBackgroundColor: '#0d6efd',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 5,
                        pointHoverRadius: 7
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0,
                                stepSize: 1
                            },
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        });
    </script>

    <style>
        .hover-light:hover {
            background-color: #f8f9fa !important;
        }
    </style>
@endsection

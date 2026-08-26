@extends('layouts.master')

@section('title', 'Laporan Perpustakaan - SIPERPUS')

@push('styles')
    
    <style>
        .card-modern {
            border: none !important;
            border-radius: 12px !important;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.03) !important;
            background: #ffffff;
        }
        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .report-icon-box {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
        }
        .form-control-modern {
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            padding: 6px 12px;
            font-size: 0.875rem;
            transition: all 0.2s ease;
        }
        .form-control-modern:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
        }
        .btn-export-pdf {
            border-radius: 8px;
            font-size: 0.825rem;
            font-weight: 600;
            padding: 6px 14px;
            background-color: #dc3545;
            color: #fff;
            border: none;
            transition: all 0.2s ease;
        }
        .btn-export-pdf:hover {
            background-color: #bb2d3b;
            color: #fff;
            transform: translateY(-1px);
        }
        .btn-export-excel {
            border-radius: 8px;
            font-size: 0.825rem;
            font-weight: 600;
            padding: 6px 14px;
            background-color: #198754;
            color: #fff;
            border: none;
            transition: all 0.2s ease;
        }
        .btn-export-excel:hover {
            background-color: #157347;
            color: #fff;
            transform: translateY(-1px);
        }
    </style>
@endpush

@section('content')
    <div class="content-wrapper bg-light">
        <!-- Content Header -->
        <div class="content-header pt-4 pb-3">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="m-0 font-weight-bold text-dark">Laporan System Perpustakaan</h4>
                        <p class="text-muted small mb-0">Cetak dan unduh laporan sistem perpustakaan dalam format PDF maupun Excel.</p>
                    </div>
                    <div class="col-sm-6 text-sm-right mt-2 mt-sm-0">
                        <ol class="breadcrumb float-sm-right bg-transparent p-0 m-0 small">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Laporan</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <section class="content pb-5">
            <div class="container-fluid">

                <!-- Widget Statistik Horizontal -->
                <div class="row mb-4">
                    <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
                        <div class="card card-modern p-3">
                            <div class="d-flex align-items-center">
                                <div class="stat-icon bg-light text-primary mr-3">
                                    <i class="fas fa-hand-holding-medical fa-lg text-primary"></i>
                                </div>
                                <div>
                                    <span class="text-muted small d-block font-weight-bold">TOTAL SIRKULASI</span>
                                    <h5 class="mb-0 font-weight-bold text-dark">{{ \App\Models\Peminjaman::count() ?? 0 }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
                        <div class="card card-modern p-3">
                            <div class="d-flex align-items-center">
                                <div class="stat-icon bg-light text-success mr-3">
                                    <i class="fas fa-book fa-lg text-success"></i>
                                </div>
                                <div>
                                    <span class="text-muted small d-block font-weight-bold">TOTAL BUKU</span>
                                    <h5 class="mb-0 font-weight-bold text-dark">{{ \App\Models\Buku::count() ?? 0 }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
                        <div class="card card-modern p-3">
                            <div class="d-flex align-items-center">
                                <div class="stat-icon bg-light text-info mr-3">
                                    <i class="fas fa-users fa-lg text-info"></i>
                                </div>
                                <div>
                                    <span class="text-muted small d-block font-weight-bold">BUKU TAMU</span>
                                    <h5 class="mb-0 font-weight-bold text-dark">{{ \App\Models\BukuTamu::count() ?? 0 }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
                        <div class="card card-modern p-3">
                            <div class="d-flex align-items-center">
                                <div class="stat-icon bg-light text-warning mr-3">
                                    <i class="fas fa-clipboard-list fa-lg text-warning"></i>
                                </div>
                                <div>
                                    <span class="text-muted small d-block font-weight-bold">TOTAL SURVEI</span>
                                    <h5 class="mb-0 font-weight-bold text-dark">
                                        {{ (\App\Models\SurveiKebutuhan::count() ?? 0) + (\App\Models\SurveiKepuasan::count() ?? 0) }}
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Tabel Laporan -->
                <div class="card card-modern mb-5">
                    <div class="card-header bg-white border-0 pt-4 px-4 pb-2">
                        <h5 class="font-weight-bold text-dark mb-0">
                            <i class="fas fa-print text-primary mr-2"></i>Daftar Modul Laporan
                        </h5>
                        <p class="text-muted small mb-0 mt-1">Pilih sub-kategori, rentang waktu, dan format unduhan yang Anda butuhkan.</p>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th width="5%" class="border-0 text-muted small font-weight-bold text-center">NO</th>
                                        <th width="35%" class="border-0 text-muted small font-weight-bold">JENIS LAPORAN & DETAIL</th>
                                        <th width="35%" class="border-0 text-muted small font-weight-bold">FILTER WAKTU</th>
                                        <th width="25%" class="border-0 text-muted small font-weight-bold text-center">AKSI CETAK / EXPORT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $laporans = [
                                            [
                                                'id' => 'master_data',
                                                'nama' => 'Laporan Master Data',
                                                'icon' => 'fa-database',
                                                'sub_jenis' => [
                                                    'anggota' => 'Data Anggota',
                                                    'buku' => 'Data Buku',
                                                    'kategori' => 'Data Kategori Buku',
                                                    'rak' => 'Data Rak Buku',
                                                ],
                                            ],
                                            [
                                                'id' => 'sirkulasi',
                                                'nama' => 'Laporan Sirkulasi Buku',
                                                'icon' => 'fa-sync-alt',
                                                'sub_jenis' => null,
                                            ],
                                            [
                                                'id' => 'berita',
                                                'nama' => 'Laporan Data Berita',
                                                'icon' => 'fa-newspaper',
                                                'sub_jenis' => null,
                                            ],
                                            [
                                                'id' => 'buku_tamu',
                                                'nama' => 'Laporan Buku Tamu',
                                                'icon' => 'fa-address-book',
                                                'sub_jenis' => null,
                                            ],
                                            [
                                                'id' => 'survei',
                                                'nama' => 'Laporan Survei & Feedback',
                                                'icon' => 'fa-clipboard-list',
                                                'sub_jenis' => [
                                                    'kebutuhan' => 'Survei Kebutuhan Buku',
                                                    'kepuasan' => 'Survei Kepuasan Pengguna',
                                                ],
                                            ],
                                        ];
                                    @endphp

                                    @foreach ($laporans as $index => $laporan)
                                        <tr>
                                            <!-- Nomor -->
                                            <td class="text-center align-middle font-weight-bold text-muted">
                                                <span class="badge badge-light border px-2 py-1">#{{ $index + 1 }}</span>
                                            </td>

                                            <!-- Kolom Jenis & Sub Jenis Laporan -->
                                            <td class="align-middle">
                                                <div class="d-flex align-items-center mb-2">
                                                    <div class="report-icon-box border mr-3">
                                                        <i class="fas {{ $laporan['icon'] }} text-primary"></i>
                                                    </div>
                                                    <div>
                                                        <span class="font-weight-bold text-dark d-block">{{ $laporan['nama'] }}</span>
                                                    </div>
                                                </div>

                                                <!-- Dropdown Sub Jenis jika ada -->
                                                @if ($laporan['sub_jenis'])
                                                    <select name="sub_jenis" form="form-{{ $laporan['id'] }}"
                                                        class="form-control form-control-modern bg-light mt-1" required>
                                                        <option value="" disabled selected>-- Pilih Sub Data --</option>
                                                        @foreach ($laporan['sub_jenis'] as $val => $label)
                                                            <option value="{{ $val }}">{{ $label }}</option>
                                                        @endforeach
                                                    </select>
                                                @else
                                                    <input type="hidden" name="sub_jenis" value="semua" form="form-{{ $laporan['id'] }}">
                                                    <span class="text-muted small">Mencetak keseluruhan data.</span>
                                                @endif
                                            </td>

                                            <!-- Kolom Filter Waktu -->
                                            <td class="align-middle">
                                                <form id="form-{{ $laporan['id'] }}" action="{{ route('admin.laporan.generate') }}" method="GET" class="m-0" target="_blank">
                                                    <input type="hidden" name="jenis_laporan" value="{{ $laporan['id'] }}">

                                                    <!-- Dropdown Rentang Waktu -->
                                                    <select name="rentang_waktu" class="form-control form-control-modern bg-light select-rentang mb-2" data-target="#custom-date-{{ $laporan['id'] }}">
                                                        <option value="semua">Semua Waktu (Cetak Seluruh Data)</option>
                                                        <option value="mingguan">Minggu Ini</option>
                                                        <option value="bulanan">Bulan Ini</option>
                                                        <option value="tahunan">Tahun Ini</option>
                                                        <option value="custom">Custom Tanggal (Pilih Sendiri)</option>
                                                    </select>

                                                    <!-- Input Custom Date -->
                                                    <div id="custom-date-{{ $laporan['id'] }}" class="input-group input-group-sm custom-date-container mt-1" style="display: none;">
                                                        <input type="date" name="start_date" class="form-control form-control-modern bg-light" title="Dari Tanggal">
                                                        <div class="input-group-prepend input-group-append">
                                                            <span class="input-group-text bg-white border-0 text-muted small">s/d</span>
                                                        </div>
                                                        <input type="date" name="end_date" class="form-control form-control-modern bg-light" title="Sampai Tanggal">
                                                    </div>
                                                </form>
                                            </td>

                                            <!-- Kolom Tombol Aksi -->
                                            <td class="text-center align-middle">
                                                <div class="btn-group" role="group">
                                                    <button type="submit" form="form-{{ $laporan['id'] }}" name="format" value="pdf" class="btn btn-export-pdf shadow-sm mr-1">
                                                        <i class="fas fa-file-pdf mr-1"></i> PDF
                                                    </button>
                                                    <button type="submit" form="form-{{ $laporan['id'] }}" name="format" value="excel" class="btn btn-export-excel shadow-sm">
                                                        <i class="fas fa-file-excel mr-1"></i> Excel
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection

@push('scripts')

    <script>
        $(document).ready(function() {
            // Flash notification via SweetAlert2
            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: "{{ session('error') }}",
                    confirmButtonColor: '#007bff'
                });
            @endif

            @if (session('info'))
                Swal.fire({
                    icon: 'info',
                    title: 'Informasi',
                    text: "{{ session('info') }}",
                    confirmButtonColor: '#007bff'
                });
            @endif

            // Toggle custom date range filter
            $('.select-rentang').on('change', function() {
                let target = $(this).data('target');
                if ($(this).val() === 'custom') {
                    $(target).slideDown(200);
                    $(target).find('input').prop('required', true);
                } else {
                    $(target).slideUp(200);
                    $(target).find('input').prop('required', false);
                    $(target).find('input').val('');
                }
            });
        });
    </script>
@endpush
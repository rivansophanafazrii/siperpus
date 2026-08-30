@extends('layouts.master')

@section('title', 'Peminjaman Saya - SIPERPUS')

@section('content')
    <style>
        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
            transition: 0.2s;
        }

        .badge-soft-danger {
            background-color: #fdeaea;
            color: #dc3545;
            border: 1px solid #dc3545;
        }

        .badge-soft-success {
            background-color: #e6f6ec;
            color: #28a745;
            border: 1px solid #28a745;
        }

        .badge-soft-warning {
            background-color: #fef5e5;
            color: #ffc107;
            border: 1px solid #ffc107;
        }

        .badge-soft-primary {
            background-color: #e6f0ff;
            color: #0d6efd;
            border: 1px solid #0d6efd;
        }
    </style>

    <div class="content-wrapper bg-light">
        <!-- Header Konten -->
        <div class="content-header pt-4 pb-3">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h3 class="m-0 font-weight-bold text-dark">Peminjaman Saya</h3>
                        <p class="text-muted small mb-0">Pantau buku yang sedang dipinjam dan perhatikan tenggat
                            pengembaliannya.</p>
                    </div>
                    <div class="col-sm-6 text-sm-right mt-2 mt-sm-0">
                        <ol class="breadcrumb float-sm-right bg-transparent p-0 m-0">
                            <li class="breadcrumb-item"><a href="{{ route('anggota.dashboard') }}"
                                    class="text-primary text-decoration-none">Dashboard</a></li>
                            <li class="breadcrumb-item active">Peminjaman Saya</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Konten Utama -->
        <section class="content">
            <div class="container-fluid">

                <!-- Pemberitahuan Status -->
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-lg"
                        role="alert">
                        <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-lg"
                        role="alert">
                        <i class="fas fa-exclamation-triangle mr-2"></i> {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <!-- Panel Tabel Peminjaman -->
                <div class="card border-0 shadow-sm rounded-lg mb-5">
                    <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                        <h5 class="font-weight-bold text-dark mb-0">
                            <i class="fas fa-book-reader text-primary mr-2"></i>Sedang Dipinjam & Perlu Dikembalikan
                        </h5>

                        <!-- Pemicu Modal Pengajuan Pinjaman -->
                        <button type="button" class="btn btn-primary btn-sm px-3 shadow-sm font-weight-bold rounded"
                            data-toggle="modal" data-target="#modalPinjamBuku">
                            <i class="fas fa-plus mr-1"></i> Pinjam Buku Baru
                        </button>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0 text-nowrap">
                                <thead class="bg-light">
                                    <tr>
                                        <th width="5%"
                                            class="text-center border-top-0 text-muted small font-weight-bold">NO</th>
                                        <th width="30%" class="border-top-0 text-muted small font-weight-bold">INFORMASI
                                            BUKU</th>
                                        <th width="15%" class="border-top-0 text-muted small font-weight-bold">TGL PINJAM
                                        </th>
                                        <th width="20%"
                                            class="text-center border-top-0 text-muted small font-weight-bold">INFO TENGGAT
                                        </th>
                                        <th width="15%"
                                            class="text-center border-top-0 text-muted small font-weight-bold">DENDA</th>
                                        <th width="7%"
                                            class="text-center border-top-0 text-muted small font-weight-bold">STATUS</th>
                                        <th width="8%"
                                            class="text-center border-top-0 text-muted small font-weight-bold">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($peminjaman as $index => $item)
                                        @php
                                            $tenggat = \Carbon\Carbon::parse($item->tenggat_waktu)->startOfDay();
                                            $hariIni = \Carbon\Carbon::now()->startOfDay();
                                            $isOverdue = $hariIni->gt($tenggat);
                                            $selisihHari = $isOverdue ? $tenggat->diffInDays($hariIni) : 0;
                                            $estimasiDenda = $selisihHari * 500;
                                        @endphp
                                        <tr>
                                            <td class="text-center align-middle font-weight-bold text-muted">
                                                {{ $peminjaman->firstItem() + $index }}
                                            </td>

                                            <td class="align-middle">
                                                <h6 class="mb-0 font-weight-bold text-dark">
                                                    {{ $item->buku->judul ?? 'Buku Tidak Ditemukan' }}</h6>
                                                <small class="text-muted"><i
                                                        class="fas fa-barcode mr-1"></i>{{ $item->buku->kode_buku ?? '-' }}</small>
                                            </td>

                                            <td class="align-middle text-muted">
                                                <i class="fas fa-calendar-alt mr-1 text-secondary"></i>
                                                {{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}
                                            </td>

                                            <td class="text-center align-middle">
                                                <div class="d-flex flex-column align-items-center">
                                                    <span
                                                        class="{{ $isOverdue ? 'text-danger font-weight-bold' : 'text-dark font-weight-bold' }}">
                                                        {{ $tenggat->format('d M Y') }}
                                                    </span>
                                                    @if ($isOverdue)
                                                        <span class="badge badge-soft-danger mt-1"
                                                            style="width: fit-content;">Terlambat</span>
                                                    @elseif ($tenggat->equalTo($hariIni))
                                                        <span class="badge badge-soft-warning mt-1"
                                                            style="width: fit-content;">Hari Ini</span>
                                                    @else
                                                        <span class="badge badge-soft-success mt-1"
                                                            style="width: fit-content;">Aman</span>
                                                    @endif
                                                </div>
                                            </td>

                                            <td class="text-center align-middle">
                                                @if ($estimasiDenda > 0)
                                                    <span class="badge badge-soft-danger px-2 py-1 shadow-none">Rp
                                                        {{ number_format($estimasiDenda, 0, ',', '.') }}</span>
                                                    <div class="small text-danger mt-1 font-weight-bold"
                                                        style="font-size: 11px;">(Estimasi)</div>
                                                @else
                                                    <span class="text-muted font-weight-bold">Rp 0</span>
                                                @endif
                                            </td>

                                            <td class="text-center align-middle">
                                                @if ($isOverdue)
                                                    <span class="badge badge-soft-danger px-2 py-1"><i
                                                            class="fas fa-exclamation-circle mr-1"></i> Telat
                                                        {{ $selisihHari }} Hari</span>
                                                @else
                                                    <span class="badge badge-soft-primary px-2 py-1"><i
                                                            class="fas fa-book-reader mr-1"></i> Dipinjam</span>
                                                @endif
                                            </td>
                                            <!-- Kolom Aksi Pengembalian dengan SweetAlert -->
                                            <td class="text-center align-middle">
                                                <form id="form-kembali-{{ $item->id }}"
                                                    action="{{ route('anggota.peminjaman.kembali', $item->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="button"
                                                        onclick="konfirmasiKembali('{{ $item->id }}')"
                                                        class="btn btn-sm btn-success font-weight-bold shadow-sm rounded-pill px-3">
                                                        <i class="fas fa-undo-alt mr-1"></i> Kembalikan
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted py-5 border-0">
                                                <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                                    style="width: 70px; height: 70px;">
                                                    <i class="fas fa-clipboard-check fa-2x text-black-50"></i>
                                                </div>
                                                <h6 class="font-weight-bold text-dark">Tidak Ada Peminjaman Aktif</h6>
                                                <p class="small mb-0">Anda sedang tidak meminjam buku apa pun saat ini.</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    @if ($peminjaman->hasPages())
                        <div
                            class="card-footer bg-white border-top py-3 d-flex flex-column flex-md-row align-items-center justify-content-between px-4">
                            <span class="text-muted small mb-2 mb-md-0">
                                Menampilkan <strong class="text-dark">{{ $peminjaman->firstItem() }}</strong> -
                                <strong class="text-dark">{{ $peminjaman->lastItem() }}</strong> dari
                                <strong class="text-dark">{{ $peminjaman->total() }}</strong> transaksi
                            </span>
                            <div>
                                {{ $peminjaman->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </div>

    <!-- Modul Form Peminjaman Buku -->
    <div class="modal fade" id="modalPinjamBuku" tabindex="-1" role="dialog" aria-labelledby="modalPinjamBukuLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0 shadow-lg rounded-lg">
                <div class="modal-header bg-primary text-white border-0">
                    <h5 class="modal-title font-weight-bold" id="modalPinjamBukuLabel">
                        <i class="fas fa-hand-holding mr-2"></i>Form Pengajuan Peminjaman
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ route('anggota.peminjaman.store') }}" method="POST">
                    @csrf
                    <div class="modal-body p-4">
                        <p class="text-muted small mb-4">Silakan pilih buku yang tersedia dan tentukan durasi peminjaman.
                            Buku yang sedang kosong tidak akan muncul dalam daftar pilihan.</p>

                        <div class="form-group mb-3">
                            <label for="buku_id" class="font-weight-bold text-dark">Pilih Koleksi Buku</label>
                            <select name="buku_id" id="buku_id" class="form-control" required>
                                <option value="" disabled selected>-- Cari dan Pilih Buku --</option>
                                <!-- Looping daftar buku dari Controller -->
                                @if (isset($buku_tersedia))
                                    @foreach ($buku_tersedia as $buku)
                                        <option value="{{ $buku->id }}">[{{ $buku->kode_buku }}] -
                                            {{ $buku->judul }} (Sisa: {{ $buku->stok }})</option>
                                    @endforeach
                                @else
                                    <option value="" disabled>Data buku belum diload dari controller.</option>
                                @endif
                            </select>
                        </div>

                        <div class="form-group mb-0">
                            <label for="lama_pinjam" class="font-weight-bold text-dark">Durasi Peminjaman (Hari)</label>
                            <select name="lama_pinjam" id="lama_pinjam" class="form-control" required>
                                <option value="3">3 Hari</option>
                                <option value="7">7 Hari (1 Minggu)</option>
                                <option value="14">14 Hari (2 Minggu)</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer bg-light border-top-0 py-3">
                        <button type="button" class="btn btn-secondary shadow-sm rounded-pill px-4"
                            data-dismiss="modal">Batal</button>
                        <button type="submit"
                            class="btn btn-primary shadow-sm rounded-pill px-4 font-weight-bold">Konfirmasi Pinjam</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            function konfirmasiKembali(id) {
                Swal.fire({
                    title: 'Konfirmasi Pengembalian',
                    text: "Apakah Anda yakin ingin mengembalikan buku ini sekarang?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Kembalikan!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('form-kembali-' + id).submit();
                    }
                });
            }
        </script>
    @endpush
@endsection

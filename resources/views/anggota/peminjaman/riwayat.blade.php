@extends('layouts.master')

@section('title', 'Riwayat Sirkulasi - SIPERPUS')

@section('content')
    <div class="content-wrapper bg-light">
        <!-- Content Header -->
        <div class="content-header pt-4 pb-3">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h3 class="m-0 font-weight-bold text-dark">Riwayat Sirkulasi</h3>
                        <p class="text-muted small mb-0">Daftar riwayat buku yang sudah selesai Anda pinjam dan kembalikan.
                        </p>
                    </div>
                    <div class="col-sm-6 text-sm-right mt-2 mt-sm-0">
                        <ol class="breadcrumb float-sm-right bg-transparent p-0 m-0">
                            <li class="breadcrumb-item"><a href="{{ route('anggota.dashboard') }}"
                                    class="text-primary">Dashboard</a></li>
                            <li class="breadcrumb-item active">Riwayat Sirkulasi</li>
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
                            <i class="fas fa-history text-success mr-2"></i>Riwayat Selesai
                        </h5>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th width="5%"
                                            class="text-center border-top-0 border-bottom-0 text-muted small font-weight-bold text-uppercase">
                                            NO</th>
                                        <th width="30%"
                                            class="border-top-0 border-bottom-0 text-muted small font-weight-bold text-uppercase">
                                            INFORMASI
                                            BUKU</th>
                                        <th width="20%"
                                            class="text-center border-top-0 border-bottom-0 text-muted small font-weight-bold text-uppercase">
                                            TENGGAT WAKTU</th>
                                        <th width="20%"
                                            class="text-center border-top-0 border-bottom-0 text-muted small font-weight-bold text-uppercase">
                                            WAKTU KEMBALI</th>
                                        <th width="15%"
                                            class="text-center border-top-0 border-bottom-0 text-muted small font-weight-bold text-uppercase">
                                            DENDA</th>
                                        <th width="10%"
                                            class="text-center border-top-0 border-bottom-0 text-muted small font-weight-bold text-uppercase">
                                            STATUS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($peminjaman as $index => $item)
                                        <tr>
                                            <td class="text-center align-middle font-weight-bold text-muted">
                                                {{ $peminjaman->firstItem() + $index }}
                                            </td>
                                            <td class="align-middle">
                                                <div class="font-weight-bold text-dark">
                                                    {{ $item->buku->judul ?? 'Buku Tidak Ditemukan' }}</div>
                                                <small class="text-muted"><i class="fas fa-barcode mr-1"></i>
                                                    {{ $item->buku->kode_buku ?? '-' }}</small>
                                            </td>
                                            <td class="text-center align-middle small font-weight-medium">
                                                <i class="far fa-clock text-warning mr-1"></i>
                                                {{ \Carbon\Carbon::parse($item->tenggat_waktu)->translatedFormat('d M Y') }}
                                            </td>
                                            <td class="text-center align-middle small font-weight-bold text-success">
                                                <i class="far fa-check-square mr-1"></i>
                                                {{ \Carbon\Carbon::parse($item->tanggal_dikembalikan)->translatedFormat('d M Y') }}
                                            </td>
                                            <td class="text-center align-middle">
                                                @if ($item->denda > 0)
                                                    <span
                                                        class="border border-danger text-danger px-2 py-1 rounded small">Rp
                                                        {{ number_format($item->denda, 0, ',', '.') }}</span>
                                                @else
                                                    <span class="text-dark small font-weight-bold">Rp 0</span>
                                                @endif
                                            </td>
                                            <td class="text-center align-middle">
                                                <span class="border border-success text-success px-2 py-1 rounded small"><i
                                                        class="fas fa-check mr-1"></i>Selesai</span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted py-5">
                                                <i class="fas fa-history fa-3x mb-3 text-black-50"></i>
                                                <h6 class="font-weight-bold text-secondary">Belum ada riwayat pengembalian
                                                    buku.</h6>
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
                                Menampilkan <strong>{{ $peminjaman->firstItem() }}</strong> -
                                <strong>{{ $peminjaman->lastItem() }}</strong> dari
                                <strong>{{ $peminjaman->total() }}</strong> riwayat
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
@endsection

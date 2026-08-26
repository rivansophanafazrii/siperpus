@extends('layouts.master')

@section('title', 'Data Pengembalian - SIPERPUS')

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

        /* Efek Animasi Halus untuk Tombol Proses Masal */
        .fade-in-btn {
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <div class="content-wrapper bg-light">
        <div class="content-header pt-4 pb-3">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h3 class="m-0 font-weight-bold text-dark">Data Pengembalian</h3>
                        <p class="text-muted small mb-0">Kelola proses pengembalian buku, perpanjangan, dan riwayat denda.
                        </p>
                    </div>
                    <div class="col-sm-6 text-sm-right mt-2 mt-sm-0">
                        <ol class="breadcrumb float-sm-right bg-transparent p-0 m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"
                                    class="text-primary">Dashboard</a></li>
                            <li class="breadcrumb-item active">Data Pengembalian</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">

                <!-- Alert Success & Error menggunakan SweetAlert2 -->
                @if (session('success'))
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: '{{ session('success') }}',
                            showConfirmButton: false,
                            timer: 3000,
                            toast: true,
                            position: 'top-end'
                        });
                    </script>
                @endif
                @if (session('error'))
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: '{{ session('error') }}',
                            showConfirmButton: true,
                        });
                    </script>
                @endif

                <!-- Form Pencarian -->
                <div class="card border-0 shadow-sm rounded-lg mb-4">
                    <div class="card-body py-3">
                        <form action="{{ route('admin.pengembalian.index') }}" method="GET"
                            class="row align-items-center">
                            <div class="col-md-10">
                                <input type="text" name="search" class="form-control"
                                    placeholder="Cari nama peminjam, NIS, atau judul buku..."
                                    value="{{ request('search') }}">
                            </div>
                            <div class="col-md-2 mt-3 mt-md-0">
                                <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-search mr-1"></i>
                                    Cari</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Form Tersembunyi Untuk Proses Masal -->
                <form action="{{ route('admin.pengembalian.proses_masal') }}" method="POST" id="formProsesMasal">
                    @csrf
                </form>

                <!-- TABEL AKTIF -->
                <div class="card border-0 shadow-sm rounded-lg mb-5">
                    <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                        <h5 class="font-weight-bold text-dark mb-0">
                            <i class="fas fa-undo text-warning mr-2"></i>Sedang Dipinjam & Perlu Dikembalikan
                        </h5>

                        <!-- TOMBOL PROSES MASAL -->
                        <button type="button" class="btn btn-success btn-sm font-weight-bold shadow-sm d-none fade-in-btn"
                            id="btnProsesMasal" onclick="submitProsesMasal()">
                            <i class="fas fa-check-double mr-1"></i> Proses <span id="countSelected"
                                class="badge badge-light text-success ml-1">0</span> Buku
                        </button>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle text-nowrap mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th width="3%" class="text-center border-top-0"><input type="checkbox"
                                                id="checkAll"></th>
                                        <th width="5%"
                                            class="text-center border-top-0 text-muted small font-weight-bold">NO</th>
                                        <th width="22%" class="border-top-0 text-muted small font-weight-bold">PEMINJAM
                                        </th>
                                        <th width="22%" class="border-top-0 text-muted small font-weight-bold">BUKU</th>
                                        <th width="15%" class="border-top-0 text-muted small font-weight-bold">TGL PINJAM
                                        </th>
                                        <th width="15%" class="border-top-0 text-muted small font-weight-bold">INFO
                                            TENGGAT</th>
                                        <th width="18%"
                                            class="text-center border-top-0 text-muted small font-weight-bold">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($peminjamanAktif as $index => $row)
                                        @php
                                            $tenggat = \Carbon\Carbon::parse($row->tenggat_waktu)->startOfDay();
                                            $hariIni = \Carbon\Carbon::now()->startOfDay();
                                            $isOverdue = $hariIni->gt($tenggat);
                                            $selisihHari = $isOverdue ? $tenggat->diffInDays($hariIni) : 0;
                                            $estimasiDenda = $selisihHari * 500;
                                        @endphp
                                        <tr>
                                            <td class="text-center align-middle">
                                                <input type="checkbox" name="ids[]" class="checkItem"
                                                    value="{{ $row->id }}" form="formProsesMasal">
                                            </td>
                                            <td class="text-center align-middle font-weight-bold text-muted">
                                                {{ $index + 1 }}</td>
                                            <td class="align-middle">
                                                <h6 class="mb-0 font-weight-bold text-dark">{{ $row->user->name ?? '-' }}
                                                </h6>
                                                <small class="text-muted"><i
                                                        class="fas fa-id-card mr-1"></i>{{ $row->user->nis_nip ?? ($row->user->username ?? '-') }}</small>
                                            </td>
                                            <td class="align-middle">
                                                <h6 class="mb-0 font-weight-bold text-dark">{{ $row->buku->judul ?? '-' }}
                                                </h6>
                                                <small class="text-muted"><i
                                                        class="fas fa-barcode mr-1"></i>{{ $row->buku->kode_buku ?? '-' }}</small>
                                            </td>
                                            <td class="align-middle text-muted">
                                                <i class="fas fa-calendar-alt mr-1 text-secondary"></i>
                                                {{ \Carbon\Carbon::parse($row->tanggal_pinjam)->format('d M Y') }}
                                            </td>
                                            <td class="align-middle">
                                                <div class="d-flex flex-column">
                                                    <span
                                                        class="{{ $isOverdue ? 'text-danger font-weight-bold' : 'text-dark font-weight-bold' }}">
                                                        {{ $tenggat->format('d M Y') }}
                                                    </span>
                                                    @if ($isOverdue)
                                                        <span class="badge badge-soft-danger mt-1"
                                                            style="width: fit-content;">Terlambat {{ $selisihHari }}
                                                            Hari</span>
                                                        <small class="text-danger font-weight-bold mt-1"
                                                            title="Estimasi denda">
                                                            <i class="fas fa-money-bill-wave mr-1"></i> Rp
                                                            {{ number_format($estimasiDenda, 0, ',', '.') }}
                                                        </small>
                                                    @else
                                                        <span class="badge badge-soft-success mt-1"
                                                            style="width: fit-content;">Aman</span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="text-center align-middle">
                                                <div class="d-flex justify-content-center" style="gap: 5px;">
                                                    @if ($hariIni->gte($tenggat))
                                                        <form id="form-perpanjang-{{ $row->id }}"
                                                            action="{{ route('admin.pengembalian.perpanjang', $row->id) }}"
                                                            method="POST">
                                                            @csrf @method('PUT')
                                                            <button type="button" onclick="confirmPerpanjang({{ $row->id }})"
                                                                class="btn btn-outline-info btn-sm font-weight-bold shadow-sm"
                                                                title="Perpanjang 7 Hari">
                                                                <i class="fas fa-calendar-plus"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                    <form id="form-kembali-{{ $row->id }}" 
                                                        action="{{ route('admin.pengembalian.proses', $row->id) }}"
                                                        method="POST">
                                                        @csrf @method('PUT')
                                                        <button type="button" onclick="confirmKembali({{ $row->id }})"
                                                            class="btn btn-primary btn-sm font-weight-bold shadow-sm px-3"
                                                            title="Kembalikan Buku">
                                                            <i class="fas fa-check mr-1"></i> Proses
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center py-5">
                                                <div class="text-muted">
                                                    <i class="fas fa-box-open fa-3x mb-3 text-light"></i>
                                                    <h6 class="font-weight-bold text-secondary">Tidak ada peminjaman aktif.
                                                    </h6>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- RIWAYAT PENGEMBALIAN -->
                <div class="card border-0 shadow-sm rounded-lg mb-5">
                    <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                        <h5 class="font-weight-bold text-dark mb-0">
                            <i class="fas fa-history text-success mr-2"></i>Riwayat Selesai
                        </h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle text-nowrap mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th width="5%"
                                            class="text-center border-top-0 text-muted small font-weight-bold">NO</th>
                                        <th width="20%" class="border-top-0 text-muted small font-weight-bold">PEMINJAM
                                        </th>
                                        <th width="25%" class="border-top-0 text-muted small font-weight-bold">BUKU
                                        </th>
                                        <th width="15%" class="border-top-0 text-muted small font-weight-bold">TENGGAT
                                            WAKTU</th>
                                        <th width="15%" class="border-top-0 text-muted small font-weight-bold">WAKTU
                                            KEMBALI</th>
                                        <th width="10%" class="border-top-0 text-muted small font-weight-bold">DENDA
                                        </th>
                                        <th width="10%"
                                            class="text-center border-top-0 text-muted small font-weight-bold">STATUS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($riwayatPengembalian as $index => $row)
                                        <tr>
                                            <td class="text-center align-middle font-weight-bold text-muted">
                                                {{ $index + 1 }}</td>
                                            <td class="align-middle">
                                                <h6 class="mb-0 font-weight-bold text-dark">{{ $row->user->name ?? '-' }}
                                                </h6>
                                                <small class="text-muted"><i
                                                        class="fas fa-id-card mr-1"></i>{{ $row->user->nis_nip ?? ($row->user->username ?? '-') }}</small>
                                            </td>
                                            <td class="align-middle">
                                                <h6 class="mb-0 font-weight-bold text-dark">{{ $row->buku->judul ?? '-' }}
                                                </h6>
                                                <small class="text-muted"><i
                                                        class="fas fa-barcode mr-1"></i>{{ $row->buku->kode_buku ?? '-' }}</small>
                                            </td>
                                            <td class="align-middle text-muted small">
                                                <i class="fas fa-clock mr-1 text-warning"></i>
                                                {{ \Carbon\Carbon::parse($row->tenggat_waktu)->format('d M Y') }}
                                            </td>
                                            <td class="align-middle text-muted small">
                                                <i class="fas fa-calendar-check mr-1 text-success"></i>
                                                {{ \Carbon\Carbon::parse($row->tanggal_dikembalikan)->format('d M Y') }}
                                            </td>
                                            <td class="align-middle">
                                                @if ($row->denda > 0)
                                                    <span class="badge badge-soft-danger px-2 py-1 shadow-none">Rp
                                                        {{ number_format($row->denda, 0, ',', '.') }}</span>
                                                @else
                                                    <span class="text-muted font-weight-bold">Rp 0</span>
                                                @endif
                                            </td>
                                            <td class="text-center align-middle">
                                                <span class="badge badge-soft-success px-2 py-1"><i
                                                        class="fas fa-check mr-1"></i> Selesai</span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center py-5 text-muted">Belum ada riwayat
                                                pengembalian buku.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>

    <!-- Script Dynamic Checkbox & SweetAlert -->
    <script>
        const checkAll = document.getElementById('checkAll');
        const checkItems = document.querySelectorAll('.checkItem');
        const btnProsesMasal = document.getElementById('btnProsesMasal');
        const countSelected = document.getElementById('countSelected');

        // Fungsi untuk mengecek jumlah centang dan menampilkan/menyembunyikan tombol
        function toggleBulkButton() {
            const checkedCount = document.querySelectorAll('.checkItem:checked').length;

            if (checkedCount > 0) {
                btnProsesMasal.classList.remove('d-none');
                countSelected.innerText = checkedCount;
            } else {
                btnProsesMasal.classList.add('d-none');
            }

            if (checkAll) {
                checkAll.checked = (checkedCount === checkItems.length && checkItems.length > 0);
            }
        }

        if (checkAll) {
            checkAll.addEventListener('change', function() {
                checkItems.forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
                toggleBulkButton();
            });
        }

        checkItems.forEach(checkbox => {
            checkbox.addEventListener('change', toggleBulkButton);
        });

        // 1. SweetAlert untuk Proses Masal
        function submitProsesMasal() {
            var checked = document.querySelectorAll('.checkItem:checked');
            if (checked.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan',
                    text: 'Pilih minimal satu buku untuk diproses.'
                });
                return;
            }
            
            Swal.fire({
                title: 'Proses ' + checked.length + ' Buku?',
                text: "Pastikan denda sudah diselesaikan jika ada keterlambatan.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Proses Semua!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('formProsesMasal').submit();
                }
            });
        }

        // 2. SweetAlert untuk Tombol Kembali Satuan
        function confirmKembali(id) {
            Swal.fire({
                title: 'Kembalikan Buku?',
                text: "Proses pengembalian buku ini? Pastikan denda sudah dibayar (jika ada).",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#007bff',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Kembalikan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('form-kembali-' + id).submit();
                }
            });
        }

        // 3. SweetAlert untuk Tombol Perpanjang
        function confirmPerpanjang(id) {
            Swal.fire({
                title: 'Perpanjang Pinjaman?',
                text: "Perpanjang masa pinjam 7 hari ke depan?",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#17a2b8',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Perpanjang!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('form-perpanjang-' + id).submit();
                }
            });
        }
    </script>
@endsection
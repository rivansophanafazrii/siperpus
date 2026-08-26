@extends('layouts.master')

@section('title', 'Kelola Buku Tamu - SIPERPUS')

@section('content')
    <div class="content-wrapper bg-light">
        <!-- Content Header -->
        <div class="content-header pt-4 pb-3">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h3 class="m-0 font-weight-bold text-dark">Data Buku Tamu</h3>
                        <p class="text-muted small mb-0">Kelola riwayat daftar pengunjung perpustakaan.</p>
                    </div>
                    <div class="col-sm-6 text-sm-right mt-2 mt-sm-0">
                        <ol class="breadcrumb float-sm-right bg-transparent p-0 m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"
                                    class="text-primary">Dashboard</a></li>
                            <li class="breadcrumb-item active">Buku Tamu</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <section class="content pb-5">
            <div class="container-fluid">
                <div class="card border-0 shadow-sm rounded-lg mb-5">
                    <div class="card-header bg-white py-3 border-0">
                        <div class="d-flex flex-wrap align-items-center justify-content-between">
                            <h5 class="font-weight-bold text-dark mb-0">
                                <i class="fas fa-address-book text-primary mr-2"></i>Daftar Pengunjung
                            </h5>

                            <!-- Menampilkan Total Pengunjung (Opsional) -->
                            <div class="d-flex align-items-center mt-2 mt-md-0">
                                <span class="badge badge-light border px-3 py-2 shadow-sm text-dark">
                                    Total: <strong>{{ $bukuTamu->total() }}</strong> Pengunjung
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0 text-center">
                                <thead class="bg-light">
                                    <tr>
                                        <th width="5%"
                                            class="border-top-0 border-bottom-0 text-muted small font-weight-bold">NO</th>
                                        <th width="20%"
                                            class="border-top-0 border-bottom-0 text-muted small font-weight-bold text-left">
                                            NAMA PENGUNJUNG</th>
                                        <th width="15%"
                                            class="border-top-0 border-bottom-0 text-muted small font-weight-bold">KELAS /
                                            INSTANSI</th>
                                        <th width="20%"
                                            class="border-top-0 border-bottom-0 text-muted small font-weight-bold text-left">
                                            TUJUAN</th>
                                        <th width="20%"
                                            class="border-top-0 border-bottom-0 text-muted small font-weight-bold text-left">
                                            KETERANGAN</th>
                                        <th width="12%"
                                            class="border-top-0 border-bottom-0 text-muted small font-weight-bold">WAKTU
                                            KUNJUNGAN</th>
                                        <th width="8%"
                                            class="border-top-0 border-bottom-0 text-muted small font-weight-bold">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($bukuTamu as $index => $item)
                                        <tr>
                                            <td class="align-middle font-weight-bold text-muted">
                                                {{ $bukuTamu->firstItem() + $index }}
                                            </td>
                                            <td class="align-middle text-left font-weight-bold text-dark">
                                                {{ $item->nama }}
                                            </td>
                                            <td class="align-middle">
                                                @if ($item->kelas_instansi)
                                                    <span
                                                        class="badge badge-info px-2 py-1 shadow-sm">{{ $item->kelas_instansi }}</span>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td class="align-middle text-left text-dark">
                                                {{ $item->tujuan }}
                                            </td>
                                            <td class="align-middle text-left small text-muted">
                                                {{ $item->keterangan ?? '-' }}
                                            </td>
                                            <td class="align-middle">
                                                <div class="small text-dark font-weight-bold">
                                                    {{ $item->created_at->translatedFormat('d M Y') }}</div>
                                                <div class="small text-muted">{{ $item->created_at->format('H:i') }} WIB
                                                </div>
                                            </td>
                                            <td class="align-middle">
                                                <form action="{{ route('admin.buku-tamu.destroy', $item->id) }}"
                                                    method="POST" class="form-delete-tamu d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <!-- Trigger JS ditambahkan ke class btn-delete-tamu -->
                                                    <button type="button"
                                                        class="btn btn-sm btn-danger btn-delete-tamu shadow-sm"
                                                        title="Hapus Data">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center py-5 text-muted">
                                                <i class="fas fa-user-times fa-3x mb-3 text-black-50"></i>
                                                <h6 class="font-weight-bold text-secondary">Belum ada riwayat pengunjung
                                                    perpustakaan.</h6>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Pagination dengan penyesuaian gaya --}}
                    @if ($bukuTamu->hasPages())
                        <div
                            class="card-footer bg-white border-top py-3 d-flex flex-column flex-md-row align-items-center justify-content-between">
                            <span class="text-muted small mb-2 mb-md-0">
                                Menampilkan <strong>{{ $bukuTamu->firstItem() }}</strong> -
                                <strong>{{ $bukuTamu->lastItem() }}</strong> dari
                                <strong>{{ $bukuTamu->total() }}</strong> pengunjung
                            </span>
                            <div>
                                {{ $bukuTamu->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Mencegah form langsung tersubmit dan menampilkannya melalui SweetAlert2
            $('.btn-delete-tamu').on('click', function(e) {
                e.preventDefault();
                let form = $(this).closest('form');

                Swal.fire({
                    title: 'Hapus Riwayat Kunjungan?',
                    text: "Data pengunjung ini akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpush

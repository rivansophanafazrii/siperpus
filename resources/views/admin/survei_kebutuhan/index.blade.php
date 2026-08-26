@extends('layouts.master')

@section('title', 'Kelola Survei Kebutuhan - SIPERPUS')

@section('content')
    <div class="content-wrapper bg-light">
        <!-- Content Header -->
        <div class="content-header pt-4 pb-3">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h3 class="m-0 font-weight-bold text-dark">Data Survei Kebutuhan</h3>
                        <p class="text-muted small mb-0">Kelola daftar usulan pengadaan buku dari pemustaka.</p>
                    </div>
                    <div class="col-sm-6 text-sm-right mt-2 mt-sm-0">
                        <ol class="breadcrumb float-sm-right bg-transparent p-0 m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"
                                    class="text-primary">Dashboard</a></li>
                            <li class="breadcrumb-item active">Survei Kebutuhan</li>
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
                                <i class="fas fa-clipboard-list text-primary mr-2"></i>Daftar Usulan Buku
                            </h5>

                            <!-- Counter Badge Total Usulan -->
                            <div class="d-flex align-items-center mt-2 mt-md-0">
                                <span class="badge badge-light border px-3 py-2 shadow-sm text-dark">
                                    Total:
                                    <strong>{{ method_exists($survei, 'total') ? $survei->total() : count($survei) }}</strong>
                                    Usulan
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
                                        <th width="15%"
                                            class="border-top-0 border-bottom-0 text-muted small font-weight-bold text-left">
                                            NAMA PEMOHON</th>
                                        <th width="10%"
                                            class="border-top-0 border-bottom-0 text-muted small font-weight-bold">PERAN
                                        </th>
                                        <th width="20%"
                                            class="border-top-0 border-bottom-0 text-muted small font-weight-bold text-left">
                                            JUDUL BUKU</th>
                                        <th width="15%"
                                            class="border-top-0 border-bottom-0 text-muted small font-weight-bold text-left">
                                            PENGARANG</th>
                                        <th width="20%"
                                            class="border-top-0 border-bottom-0 text-muted small font-weight-bold text-left">
                                            ALASAN USULAN</th>
                                        <th width="10%"
                                            class="border-top-0 border-bottom-0 text-muted small font-weight-bold">TANGGAL
                                        </th>
                                        <th width="5%"
                                            class="border-top-0 border-bottom-0 text-muted small font-weight-bold">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($survei as $index => $item)
                                        <tr>
                                            <td class="align-middle font-weight-bold text-muted">
                                                {{ method_exists($survei, 'firstItem') ? $survei->firstItem() + $index : $index + 1 }}
                                            </td>
                                            <td class="align-middle text-left font-weight-bold text-dark">
                                                {{ $item->nama }}
                                            </td>
                                            <td class="align-middle">
                                                <span class="badge badge-info px-2 py-1 shadow-sm">
                                                    {{ $item->peran ?? 'Umum' }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-left font-weight-bold text-primary">
                                                {{ $item->judul_buku }}
                                            </td>
                                            <td class="align-middle text-left text-dark">
                                                {{ $item->pengarang ?? '-' }}
                                            </td>
                                            <td class="align-middle text-left small text-muted">
                                                {{ Str::limit($item->alasan, 50, '...') }}
                                            </td>
                                            <td class="align-middle">
                                                <div class="small text-dark font-weight-bold">
                                                    {{ $item->created_at->translatedFormat('d M Y') }}</div>
                                                <div class="small text-muted">{{ $item->created_at->format('H:i') }} WIB
                                                </div>
                                            </td>
                                            <td class="align-middle">
                                                <form action="{{ route('admin.survei-kebutuhan.destroy', $item->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="btn btn-sm btn-danger btn-delete-survei shadow-sm"
                                                        title="Hapus Data">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center py-5 text-muted">
                                                <i class="fas fa-folder-open fa-3x mb-3 text-black-50"></i>
                                                <h6 class="font-weight-bold text-secondary">Belum ada usulan pengadaan buku
                                                    dari pemustaka.</h6>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Pagination --}}
                    @if (method_exists($survei, 'hasPages') && $survei->hasPages())
                        <div
                            class="card-footer bg-white border-top py-3 d-flex flex-column flex-md-row align-items-center justify-content-between">
                            <span class="text-muted small mb-2 mb-md-0">
                                Menampilkan <strong>{{ $survei->firstItem() }}</strong> -
                                <strong>{{ $survei->lastItem() }}</strong> dari <strong>{{ $survei->total() }}</strong>
                                usulan
                            </span>
                            <div>
                                {{ $survei->links('pagination::bootstrap-4') }}
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
            // Intersepsi submit hapus dengan SweetAlert2
            $('.btn-delete-survei').on('click', function(e) {
                e.preventDefault();
                let form = $(this).closest('form');

                Swal.fire({
                    title: 'Hapus Usulan Buku?',
                    text: "Data usulan ini akan dihapus secara permanen!",
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

@extends('layouts.master')

@section('title', 'Kelola Survei Kepuasan - SIPERPUS')

@section('content')
    <div class="content-wrapper bg-light">
        <!-- Content Header -->
        <div class="content-header pt-4 pb-3">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h3 class="m-0 font-weight-bold text-dark">Data Survei Kepuasan</h3>
                        <p class="text-muted small mb-0">Kelola daftar penilaian dan masukan dari pengunjung perpustakaan.
                        </p>
                    </div>
                    <div class="col-sm-6 text-sm-right mt-2 mt-sm-0">
                        <ol class="breadcrumb float-sm-right bg-transparent p-0 m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"
                                    class="text-primary">Dashboard</a></li>
                            <li class="breadcrumb-item active">Survei Kepuasan</li>
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
                                <i class="fas fa-smile text-primary mr-2"></i>Hasil Survei Kepuasan
                            </h5>

                            <!-- Counter Badge Total Responden -->
                            <div class="d-flex align-items-center mt-2 mt-md-0">
                                <span class="badge badge-light border px-3 py-2 shadow-sm text-dark">
                                    Total: <strong>{{ $survei->total() }}</strong> Responden
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
                                            NAMA</th>
                                        <th width="10%"
                                            class="border-top-0 border-bottom-0 text-muted small font-weight-bold">PERAN
                                        </th>
                                        <th width="15%"
                                            class="border-top-0 border-bottom-0 text-muted small font-weight-bold">TINGKAT
                                            KEPUASAN</th>
                                        <th width="35%"
                                            class="border-top-0 border-bottom-0 text-muted small font-weight-bold text-left">
                                            SARAN & MASUKAN</th>
                                        <th width="12%"
                                            class="border-top-0 border-bottom-0 text-muted small font-weight-bold">TANGGAL
                                        </th>
                                        <th width="8%"
                                            class="border-top-0 border-bottom-0 text-muted small font-weight-bold">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($survei as $index => $item)
                                        <tr>
                                            <td class="align-middle font-weight-bold text-muted">
                                                {{ $survei->firstItem() + $index }}
                                            </td>
                                            <td class="align-middle text-left font-weight-bold text-dark">
                                                {{ $item->nama }}
                                            </td>
                                            <td class="align-middle">
                                                <span class="badge badge-info px-2 py-1 shadow-sm">
                                                    {{ $item->peran ?? 'Umum' }}
                                                </span>
                                            </td>
                                            <td class="align-middle font-weight-bold">
                                                @php
                                                    $kepuasan = strtolower($item->kepuasan);
                                                    $badgeClass = 'badge-secondary';
                                                    if (str_contains($kepuasan, 'sangat puas')) {
                                                        $badgeClass = 'badge-success';
                                                    } elseif (str_contains($kepuasan, 'puas')) {
                                                        $badgeClass = 'badge-primary';
                                                    } elseif (str_contains($kepuasan, 'cukup')) {
                                                        $badgeClass = 'badge-warning text-white';
                                                    } elseif (str_contains($kepuasan, 'kurang')) {
                                                        $badgeClass = 'badge-danger';
                                                    }
                                                @endphp
                                                <span class="badge {{ $badgeClass }} px-3 py-2 shadow-sm">
                                                    {{ $item->kepuasan }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-left small text-muted">
                                                {{ $item->saran ?? 'Tidak ada masukan.' }}
                                            </td>
                                            <td class="align-middle">
                                                <div class="small text-dark font-weight-bold">
                                                    {{ $item->created_at->translatedFormat('d M Y') }}</div>
                                                <div class="small text-muted">{{ $item->created_at->format('H:i') }} WIB
                                                </div>
                                            </td>
                                            <td class="align-middle">
                                                <form action="{{ route('admin.survei-kepuasan.destroy', $item->id) }}"
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
                                            <td colspan="7" class="text-center py-5 text-muted">
                                                <i class="fas fa-smile-beam fa-3x mb-3 text-black-50"></i>
                                                <h6 class="font-weight-bold text-secondary">Belum ada data survei kepuasan
                                                    yang masuk.</h6>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Pagination --}}
                    @if ($survei->hasPages())
                        <div
                            class="card-footer bg-white border-top py-3 d-flex flex-column flex-md-row align-items-center justify-content-between">
                            <span class="text-muted small mb-2 mb-md-0">
                                Menampilkan <strong>{{ $survei->firstItem() }}</strong> -
                                <strong>{{ $survei->lastItem() }}</strong> dari <strong>{{ $survei->total() }}</strong>
                                responden
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
            // SweetAlert2 Konfirmasi Hapus
            $('.btn-delete-survei').on('click', function(e) {
                e.preventDefault();
                let form = $(this).closest('form');

                Swal.fire({
                    title: 'Hapus Data Survei?',
                    text: "Data penilaian responden ini akan dihapus secara permanen!",
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

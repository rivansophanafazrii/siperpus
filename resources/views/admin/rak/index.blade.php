@extends('layouts.master')

@section('title', 'Data Rak Buku - SIPERPUS')

@section('content')
    <style>
        .hover-icon:hover {
            color: #0d6efd !important;
        }

        .hover-icon-danger:hover {
            color: #dc3545 !important;
        }

        .object-fit-cover {
            object-fit: cover;
        }

        .form-control:focus {
            background-color: #fff !important;
            box-shadow: none;
        }

        .badge-soft-primary {
            background-color: #e6f0ff;
            color: #0d6efd;
            border: 1px solid #b6d4fe;
        }

        .badge-soft-success {
            background-color: #e6f6ec;
            color: #28a745;
            border: 1px solid #a3e6cd;
        }

        .badge-soft-warning {
            background-color: #fef5e5;
            color: #fd7e14;
            border: 1px solid #fecba1;
        }

        .badge-soft-danger {
            background-color: #fdf5f6;
            color: #dc3545;
            border: 1px solid #f8d7da;
        }

        .badge-soft-info {
            background-color: #e6f7ff;
            color: #0dcaf0;
            border: 1px solid #9eeaf9;
        }

        .badge-soft-secondary {
            background-color: #f1f3f5;
            color: #6c757d;
            border: 1px solid #ced4da;
        }
    </style>

    <div class="content-wrapper bg-light">
        <!-- Content Header -->
        <div class="content-header pt-4 pb-3">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h3 class="m-0 font-weight-bold text-dark">Data Rak Buku</h3>
                        <p class="text-muted small mb-0">Kelola daftar lokasi fisik penyimpanan buku perpustakaan.</p>
                    </div>
                    <div class="col-sm-6 text-sm-right mt-2 mt-sm-0">
                        <ol class="breadcrumb float-sm-right bg-transparent p-0 m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"
                                    class="text-primary text-decoration-none">Dashboard</a></li>
                            <li class="breadcrumb-item active">Rak Buku</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <section class="content">
            <div class="container-fluid">

                <!-- Widget Statistik Horizontal -->
                <div class="row mb-4">
                    <div class="col-lg-4 col-md-6 col-12 mb-3">
                        <div class="card border-0 shadow-sm rounded-lg h-100">
                            <div class="card-body p-4 d-flex align-items-center">
                                <div class="rounded-circle d-flex align-items-center justify-content-center"
                                    style="width: 55px; height: 55px; background-color: #e6f7ff; color: #0dcaf0;">
                                    <i class="fas fa-archive fa-lg"></i>
                                </div>
                                <div class="ml-3">
                                    <div class="text-muted small font-weight-bold mb-1">Total Rak Buku</div>
                                    <div class="h3 font-weight-bold text-dark mb-0">
                                        {{ \App\Models\Rak::count() ?? 0 }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Tabel Utama -->
                <div class="card border-0 shadow-sm rounded-lg mb-5">
                    <div class="card-header bg-white py-3 border-0">
                        <div class="d-flex flex-wrap align-items-center justify-content-between">
                            <h5 class="font-weight-bold text-dark mb-2 mb-md-0">
                                <i class="fas fa-list text-primary mr-2"></i>Daftar Rak
                            </h5>

                            <!-- Toolbar Filter & Action -->
                            <div class="d-flex align-items-center flex-wrap">
                                <form action="{{ route('admin.rak.index') }}" method="GET" class="mr-2 mb-0">
                                    <div class="input-group input-group-sm" style="width: 250px;">
                                        <input type="text" name="search" class="form-control bg-light border-right-0"
                                            placeholder="Cari nama rak atau lokasi..." value="{{ request('search') }}">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-primary px-3">
                                                <i class="fas fa-search"></i>
                                            </button>
                                            @if (request('search'))
                                                <a href="{{ route('admin.rak.index') }}"
                                                    class="btn btn-light text-danger border border-left-0"
                                                    title="Reset Search">
                                                    <i class="fas fa-times"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </form>

                                <!-- Tombol Bulk Action -->
                                <button type="button" id="btn-bulk-delete"
                                    class="btn btn-danger btn-sm px-3 shadow-sm font-weight-bold rounded mr-2"
                                    style="display: none;">
                                    <i class="fas fa-trash-alt mr-1"></i> Hapus Terpilih (<span
                                        id="count-selected">0</span>)
                                </button>

                                <a href="{{ route('admin.rak.create') }}"
                                    class="btn btn-primary btn-sm px-3 shadow-sm font-weight-bold rounded">
                                    <i class="fas fa-plus mr-1"></i> Tambah Rak
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <form action="{{ route('admin.rak.bulkDestroy') }}" method="POST" id="form-bulk-action">
                            @csrf
                            @method('DELETE')
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0 text-nowrap">
                                    <thead class="bg-light">
                                        <tr>
                                            <th width="4%"
                                                class="text-center align-middle border-top-0 border-bottom-0">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="checkAll">
                                                    <label class="custom-control-label" for="checkAll"></label>
                                                </div>
                                            </th>
                                            <th width="5%"
                                                class="text-center border-top-0 border-bottom-0 text-muted small font-weight-bold">
                                                NO</th>
                                            <th width="25%"
                                                class="border-top-0 border-bottom-0 text-muted small font-weight-bold">NAMA
                                                RAK</th>
                                            <th width="25%"
                                                class="border-top-0 border-bottom-0 text-muted small font-weight-bold">
                                                LOKASI</th>
                                            <th width="26%"
                                                class="border-top-0 border-bottom-0 text-muted small font-weight-bold">
                                                KETERANGAN</th>
                                            <th width="15%"
                                                class="text-center border-top-0 border-bottom-0 text-muted small font-weight-bold">
                                                AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($rak as $index => $row)
                                            <tr>
                                                <td class="text-center align-middle">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input checkItem"
                                                            id="check-{{ $row->id }}" name="ids[]"
                                                            value="{{ $row->id }}">
                                                        <label class="custom-control-label"
                                                            for="check-{{ $row->id }}"></label>
                                                    </div>
                                                </td>
                                                <td class="text-center align-middle font-weight-bold text-muted">
                                                    {{ $rak->firstItem() + $index }}
                                                </td>
                                                <td class="align-middle font-weight-bold text-dark">
                                                    {{ $row->nama_rak }}
                                                </td>
                                                <td class="align-middle text-muted">
                                                    <span class="badge badge-soft-info px-2 py-1">
                                                        <i class="fas fa-map-marker-alt mr-1"></i> {{ $row->lokasi }}
                                                    </span>
                                                </td>
                                                <td class="align-middle text-muted small"
                                                    style="white-space: normal; max-width: 250px;">
                                                    {{ Str::limit($row->keterangan ?? 'Tidak ada keterangan tambahan.', 60) }}
                                                </td>
                                                <td class="text-center align-middle">
                                                    <div class="btn-group btn-group-sm" role="group">
                                                        <a href="{{ route('admin.rak.show', $row->id) }}"
                                                            class="btn btn-info" title="Lihat Detail">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('admin.rak.edit', $row->id) }}"
                                                            class="btn btn-warning text-white" title="Edit Data">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <button type="button" class="btn btn-danger btn-delete-single"
                                                            data-id="{{ $row->id }}" title="Hapus Data">
                                                            <i class="fas fa-trash pointer-events-none"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center text-muted py-5 border-0">
                                                    <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                                        style="width: 70px; height: 70px;">
                                                        <i class="fas fa-archive fa-2x text-black-50"></i>
                                                    </div>
                                                    <h6 class="font-weight-bold text-dark">Data Tidak Ditemukan</h6>
                                                    <p class="small mb-0">Belum ada data rak atau kata kunci pencarian
                                                        tidak cocok.</p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </form>

                        <form id="form-delete-single" action="" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>

                    @if ($rak->hasPages())
                        <div
                            class="card-footer bg-white border-top py-3 d-flex flex-column flex-md-row align-items-center justify-content-between px-4">
                            <span class="text-muted small mb-2 mb-md-0">
                                Menampilkan <strong class="text-dark">{{ $rak->firstItem() }}</strong> -
                                <strong class="text-dark">{{ $rak->lastItem() }}</strong> dari <strong
                                    class="text-dark">{{ $rak->total() }}</strong> rak
                            </span>
                            <div>
                                {{ $rak->links() }}
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
            // Select All Checkbox
            $('#checkAll').on('click', function() {
                $('.checkItem').prop('checked', $(this).prop('checked'));
                toggleBulkDeleteButton();
            });

            // Toggle individual item
            $('.checkItem').on('change', function() {
                if ($('.checkItem:checked').length == $('.checkItem').length) {
                    $('#checkAll').prop('checked', true);
                } else {
                    $('#checkAll').prop('checked', false);
                }
                toggleBulkDeleteButton();
            });

            function toggleBulkDeleteButton() {
                let checkedCount = $('.checkItem:checked').length;
                if (checkedCount > 0) {
                    $('#count-selected').text(checkedCount);
                    $('#btn-bulk-delete').fadeIn(200);
                } else {
                    $('#btn-bulk-delete').fadeOut(200);
                }
            }

            // Trigger Bulk Delete Action dengan SweetAlert
            $('#btn-bulk-delete').on('click', function() {
                let count = $('.checkItem:checked').length;
                
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Menghapus " + count + " data pengguna yang dipilih tidak dapat dibatalkan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#form-bulk-action').submit();
                    }
                });
            });

            // Trigger Single Delete Action dengan SweetAlert
            $('.btn-delete-single').on('click', function() {
                let id = $(this).data('id');
                let url = "{{ url('admin/rak') }}/" + id;

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data pengguna ini akan dihapus permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#form-delete-single').attr('action', url).submit();
                    }
                });
            });
        });
    </script>
@endpush
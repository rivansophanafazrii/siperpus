@extends('layouts.master')

@section('title', 'Data Anggota - SIPERPUS')

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
                        <h3 class="m-0 font-weight-bold text-dark">Data Anggota</h3>
                        <p class="text-muted small mb-0">Kelola data seluruh anggota, siswa, guru, staf, dan administrator
                            sistem.</p>
                    </div>
                    <div class="col-sm-6 text-sm-right mt-2 mt-sm-0">
                        <ol class="breadcrumb float-sm-right bg-transparent p-0 m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"
                                    class="text-primary text-decoration-none">Dashboard</a></li>
                            <li class="breadcrumb-item active">Data Anggota</li>
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
                    <!-- Total Anggota -->
                    <div class="col-lg-3 col-md-6 col-12 mb-3">
                        <div class="card border-0 shadow-sm rounded-lg h-100">
                            <div class="card-body p-4 d-flex align-items-center">
                                <div class="rounded-circle d-flex align-items-center justify-content-center"
                                    style="width: 55px; height: 55px; background-color: #e7f0ff; color: #0d6efd;">
                                    <i class="fas fa-users fa-lg"></i>
                                </div>
                                <div class="ml-3">
                                    <div class="text-muted small font-weight-bold mb-1">Total Anggota</div>
                                    <div class="h3 font-weight-bold text-dark mb-0">{{ \App\Models\User::count() }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Siswa -->
                    <div class="col-lg-3 col-md-6 col-12 mb-3">
                        <div class="card border-0 shadow-sm rounded-lg h-100">
                            <div class="card-body p-4 d-flex align-items-center">
                                <div class="rounded-circle d-flex align-items-center justify-content-center"
                                    style="width: 55px; height: 55px; background-color: #e8f5e9; color: #28a745;">
                                    <i class="fas fa-user-graduate fa-lg"></i>
                                </div>
                                <div class="ml-3">
                                    <div class="text-muted small font-weight-bold mb-1">Siswa</div>
                                    <div class="h3 font-weight-bold text-dark mb-0">
                                        {{ \App\Models\User::where('tipe_anggota', 'siswa')->count() }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Guru & Staf -->
                    <div class="col-lg-3 col-md-6 col-12 mb-3">
                        <div class="card border-0 shadow-sm rounded-lg h-100">
                            <div class="card-body p-4 d-flex align-items-center">
                                <div class="rounded-circle d-flex align-items-center justify-content-center"
                                    style="width: 55px; height: 55px; background-color: #fff3e0; color: #fd7e14;">
                                    <i class="fas fa-user-tie fa-lg"></i>
                                </div>
                                <div class="ml-3">
                                    <div class="text-muted small font-weight-bold mb-1">Guru & Staf</div>
                                    <div class="h3 font-weight-bold text-dark mb-0">
                                        {{ \App\Models\User::whereIn('tipe_anggota', ['guru', 'staf'])->count() }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Administrator -->
                    <div class="col-lg-3 col-md-6 col-12 mb-3">
                        <div class="card border-0 shadow-sm rounded-lg h-100">
                            <div class="card-body p-4 d-flex align-items-center">
                                <div class="rounded-circle d-flex align-items-center justify-content-center"
                                    style="width: 55px; height: 55px; background-color: #f3e5f5; color: #6f42c1;">
                                    <i class="fas fa-user-shield fa-lg"></i>
                                </div>
                                <div class="ml-3">
                                    <div class="text-muted small font-weight-bold mb-1">Administrator</div>
                                    <div class="h3 font-weight-bold text-dark mb-0">
                                        {{ \App\Models\User::where('role', 'admin')->count() }}</div>
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
                                <i class="fas fa-address-book text-primary mr-2"></i>Daftar Pengguna Sistem
                            </h5>

                            <!-- Toolbar Filter & Action -->
                            <div class="d-flex align-items-center flex-wrap">
                                <form action="{{ route('admin.anggota.index') }}" method="GET" class="mr-2 mb-0">
                                    <div class="input-group input-group-sm" style="width: 260px;">
                                        <input type="text" name="search" class="form-control bg-light border-right-0"
                                            placeholder="Cari nama, NIS, atau email..." value="{{ request('search') }}">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-primary px-3">
                                                <i class="fas fa-search"></i>
                                            </button>
                                            @if (request('search'))
                                                <a href="{{ route('admin.anggota.index') }}"
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

                                <a href="{{ route('admin.anggota.create') }}"
                                    class="btn btn-primary btn-sm px-3 shadow-sm font-weight-bold rounded">
                                    <i class="fas fa-plus mr-1"></i> Tambah Anggota
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <form action="{{ route('admin.anggota.bulkDestroy') }}" method="POST" id="form-bulk-action">
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
                                            <th width="26%"
                                                class="border-top-0 border-bottom-0 text-muted small font-weight-bold">
                                                PENGGUNA</th>
                                            <th width="15%"
                                                class="border-top-0 border-bottom-0 text-muted small font-weight-bold">
                                                KELAS / JABATAN</th>
                                            <th width="20%"
                                                class="border-top-0 border-bottom-0 text-muted small font-weight-bold">
                                                KONTAK</th>
                                            <th width="12%"
                                                class="border-top-0 border-bottom-0 text-muted small font-weight-bold">
                                                KATEGORI</th>
                                            <th width="10%"
                                                class="border-top-0 border-bottom-0 text-muted small font-weight-bold">
                                                STATUS</th>
                                            <th width="8%"
                                                class="text-center border-top-0 border-bottom-0 text-muted small font-weight-bold">
                                                AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($anggota as $index => $row)
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
                                                    {{ $anggota->firstItem() + $index }}
                                                </td>
                                                <td class="align-middle">
                                                    <div class="d-flex align-items-center">
                                                        @if ($row->foto)
                                                            <img src="{{ asset('storage/' . $row->foto) }}"
                                                                alt="Foto"
                                                                class="rounded-circle mr-3 object-fit-cover shadow-sm"
                                                                style="width: 42px; height: 42px;">
                                                        @else
                                                            <div class="rounded-circle mr-3 d-flex align-items-center justify-content-center"
                                                                style="width: 42px; height: 42px; background-color: #e9ecef; color: #495057; font-size: 1.1rem; font-weight: 600;">
                                                                {{ strtoupper(substr($row->name, 0, 1)) }}
                                                            </div>
                                                        @endif
                                                        <div>
                                                            <a href="{{ route('admin.anggota.show', $row->id) }}"
                                                                class="font-weight-bold text-dark text-decoration-none d-block mb-0">
                                                                {{ $row->name }}
                                                            </a>
                                                            <small class="text-muted"><i
                                                                    class="fas fa-id-card mr-1"></i>{{ $row->nis_nip ?? $row->username }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="align-middle">
                                                    @if ($row->tipe_anggota == 'siswa')
                                                        <span class="badge badge-soft-primary px-2 py-1"><i
                                                                class="fas fa-school mr-1"></i> Kelas
                                                            {{ $row->kelas ?? '-' }}</span>
                                                    @else
                                                        <span class="badge badge-soft-secondary px-2 py-1"><i
                                                                class="fas fa-briefcase mr-1"></i>
                                                            {{ ucfirst($row->jabatan ?? ($row->tipe_anggota ?? 'Staf')) }}</span>
                                                    @endif
                                                </td>
                                                <td class="align-middle">
                                                    <div class="text-dark small font-weight-medium mb-0">
                                                        {{ $row->email ?? '-' }}
                                                    </div>
                                                    <small class="text-muted"><i
                                                            class="fas fa-phone-alt mr-1"></i>{{ $row->no_telepon ?? '-' }}</small>
                                                </td>
                                                <td class="align-middle">
                                                    @if ($row->role == 'admin')
                                                        <span
                                                            class="badge badge-soft-info px-2 py-1 text-capitalize">Admin</span>
                                                    @elseif($row->tipe_anggota == 'siswa')
                                                        <span
                                                            class="badge badge-soft-success px-2 py-1 text-capitalize">Siswa</span>
                                                    @elseif($row->tipe_anggota == 'guru')
                                                        <span
                                                            class="badge badge-soft-warning px-2 py-1 text-capitalize">Guru</span>
                                                    @else
                                                        <span
                                                            class="badge badge-soft-secondary px-2 py-1 text-capitalize">{{ $row->tipe_anggota ?? 'Anggota' }}</span>
                                                    @endif
                                                </td>
                                                <td class="align-middle">
                                                    @if ($row->status == 'aktif')
                                                        <span class="text-success small font-weight-bold"><i
                                                                class="fas fa-circle mr-1" style="font-size: 8px;"></i>
                                                            Aktif</span>
                                                    @elseif($row->status == 'nonaktif')
                                                        <span class="text-secondary small font-weight-bold"><i
                                                                class="fas fa-circle mr-1" style="font-size: 8px;"></i>
                                                            Non-Aktif</span>
                                                    @elseif($row->status == 'lulus')
                                                        <span class="text-info small font-weight-bold"><i
                                                                class="fas fa-circle mr-1" style="font-size: 8px;"></i>
                                                            Lulus</span>
                                                    @else
                                                        <span class="text-warning small font-weight-bold"><i
                                                                class="fas fa-circle mr-1" style="font-size: 8px;"></i>
                                                            Pindah</span>
                                                    @endif
                                                </td>
                                                <td class="text-center align-middle">
                                                    <div class="btn-group btn-group-sm" role="group">
                                                        <a href="{{ route('admin.anggota.show', $row->id) }}"
                                                            class="btn btn-info" title="Lihat Detail">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('admin.anggota.edit', $row->id) }}"
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
                                                <td colspan="8" class="text-center text-muted py-5 border-0">
                                                    <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                                        style="width: 70px; height: 70px;">
                                                        <i class="fas fa-folder-open fa-2x text-black-50"></i>
                                                    </div>
                                                    <h6 class="font-weight-bold text-dark">Data Tidak Ditemukan</h6>
                                                    <p class="small mb-0">Belum ada data anggota atau kata kunci pencarian
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

                    @if ($anggota->hasPages())
                        <div
                            class="card-footer bg-white border-top py-3 d-flex flex-column flex-md-row align-items-center justify-content-between px-4">
                            <span class="text-muted small mb-2 mb-md-0">
                                Menampilkan <strong class="text-dark">{{ $anggota->firstItem() }}</strong> -
                                <strong class="text-dark">{{ $anggota->lastItem() }}</strong> dari
                                <strong class="text-dark">{{ $anggota->total() }}</strong> anggota
                            </span>
                            <div>
                                {{ $anggota->links() }}
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
                    text: "Menghapus " + count +
                        " data pengguna yang dipilih tidak dapat dibatalkan!",
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
                let url = "{{ url('admin/anggota') }}/" + id;

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

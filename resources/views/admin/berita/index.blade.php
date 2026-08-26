@extends('layouts.master')

@section('title', 'Data Berita & Publikasi - SIPERPUS')

@section('content')
<div class="content-wrapper bg-light">
    <!-- Content Header -->
    <div class="content-header pt-4 pb-3">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="m-0 font-weight-bold text-dark">Data Berita & Publikasi</h3>
                    <p class="text-muted small mb-0">Kelola informasi, pengumuman, dan artikel literasi perpustakaan.</p>
                </div>
                <div class="col-sm-6 text-sm-right mt-2 mt-sm-0">
                    <ol class="breadcrumb float-sm-right bg-transparent p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-primary">Dashboard</a></li>
                        <li class="breadcrumb-item active">Data Berita</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">

            <!-- Widget Statistik Horizontal -->
            <div class="row mb-3">
                <!-- Total Berita -->
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="card border-0 shadow-sm rounded-lg mb-0">
                        <div class="card-body p-3 d-flex align-items-center">
                            <div class="bg-primary text-white rounded p-3 mr-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                <i class="fas fa-newspaper fa-lg"></i>
                            </div>
                            <div>
                                <div class="text-muted small font-weight-normal">Total Publikasi</div>
                                <div class="h5 font-weight-bold text-dark mb-0">{{ \App\Models\Berita::count() }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Berita Tayang -->
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="card border-0 shadow-sm rounded-lg mb-0">
                        <div class="card-body p-3 d-flex align-items-center">
                            <div class="bg-success text-white rounded p-3 mr-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                <i class="fas fa-globe fa-lg"></i>
                            </div>
                            <div>
                                <div class="text-muted small font-weight-normal">Berita Tayang</div>
                                <div class="h5 font-weight-bold text-dark mb-0">
                                    {{ \App\Models\Berita::where('is_published', true)->count() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Berita Draft -->
                <div class="col-lg-4 col-md-6 col-12 mb-3">
                    <div class="card border-0 shadow-sm rounded-lg mb-0">
                        <div class="card-body p-3 d-flex align-items-center">
                            <div class="bg-warning text-dark rounded p-3 mr-3 d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                <i class="fas fa-file-alt fa-lg"></i>
                            </div>
                            <div>
                                <div class="text-muted small font-weight-normal">Draft Tersimpan</div>
                                <div class="h5 font-weight-bold text-dark mb-0">
                                    {{ \App\Models\Berita::where('is_published', false)->count() }}
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
                            <i class="fas fa-list text-primary mr-2"></i>Daftar Berita
                        </h5>

                        <!-- Toolbar Filter & Action -->
                        <div class="d-flex align-items-center flex-wrap">
                            <form action="{{ route('admin.berita.index') }}" method="GET" class="mr-2 mb-0">
                                <div class="input-group input-group-sm" style="width: 250px;">
                                    <input type="text" name="search" class="form-control bg-light border-right-0" placeholder="Cari judul atau kategori..." value="{{ request('search') }}">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary px-3">
                                            <i class="fas fa-search"></i>
                                        </button>
                                        @if (request('search'))
                                            <a href="{{ route('admin.berita.index') }}" class="btn btn-light text-danger border border-left-0" title="Reset Search">
                                                <i class="fas fa-times"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </form>

                            <!-- Tombol Bulk Action -->
                            <button type="button" id="btn-bulk-delete" class="btn btn-danger btn-sm px-3 shadow-sm font-weight-bold rounded mr-2" style="display: none;">
                                <i class="fas fa-trash-alt mr-1"></i> Hapus Terpilih (<span id="count-selected">0</span>)
                            </button>

                            <a href="{{ route('admin.berita.create') }}" class="btn btn-primary btn-sm px-3 shadow-sm font-weight-bold rounded">
                                <i class="fas fa-plus mr-1"></i> Tambah Berita
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body p-0">
                    <!-- Form untuk Bulk Delete -->
                    <form action="{{ route('admin.berita.bulkDestroy') }}" method="POST" id="form-bulk-action">
                        @csrf
                        @method('DELETE')
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th width="4%" class="text-center align-middle border-top-0 border-bottom-0">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="checkAll">
                                                <label class="custom-control-label" for="checkAll"></label>
                                            </div>
                                        </th>
                                        <th width="5%" class="text-center border-top-0 border-bottom-0 text-muted small font-weight-bold">NO</th>
                                        <th width="15%" class="text-center border-top-0 border-bottom-0 text-muted small font-weight-bold">GAMBAR</th>
                                        <th width="35%" class="border-top-0 border-bottom-0 text-muted small font-weight-bold">JUDUL & KATEGORI</th>
                                        <th width="15%" class="text-center border-top-0 border-bottom-0 text-muted small font-weight-bold">TANGGAL DIBUAT</th>
                                        <th width="12%" class="text-center border-top-0 border-bottom-0 text-muted small font-weight-bold">STATUS</th>
                                        <th width="14%" class="text-center border-top-0 border-bottom-0 text-muted small font-weight-bold">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($berita as $index => $row)
                                        <tr>
                                            <td class="text-center align-middle">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input checkItem" id="check-{{ $row->id }}" name="ids[]" value="{{ $row->id }}">
                                                    <label class="custom-control-label" for="check-{{ $row->id }}"></label>
                                                </div>
                                            </td>
                                            <td class="text-center align-middle font-weight-bold text-muted">
                                                {{ $berita->firstItem() + $index }}
                                            </td>

                                            <!-- Gambar Berita -->
                                            <td class="text-center align-middle">
                                                @if ($row->gambar)
                                                    <img src="{{ asset('storage/' . $row->gambar) }}" alt="Gambar" class="rounded border shadow-sm" style="width: 80px; height: 50px; object-fit: cover;">
                                                @else
                                                    <div class="bg-light text-muted font-weight-bold rounded d-flex align-items-center justify-content-center border mx-auto" style="width: 80px; height: 50px; font-size: 0.8rem;">
                                                        <i class="fas fa-image"></i>
                                                    </div>
                                                @endif
                                            </td>

                                            <!-- Judul & Kategori -->
                                            <td class="align-middle">
                                                <div class="font-weight-bold text-dark d-block text-truncate" style="max-width: 300px;">
                                                    {{ $row->judul }}
                                                </div>
                                                <div class="mt-1">
                                                    <span class="badge badge-light border px-2 py-1">
                                                        <i class="fas fa-tag text-primary mr-1"></i> {{ $row->kategori }}
                                                    </span>
                                                </div>
                                            </td>

                                            <!-- Tanggal -->
                                            <td class="text-center align-middle">
                                                <div class="small text-dark font-weight-bold">{{ $row->created_at->format('d M Y') }}</div>
                                                <div class="small text-muted">{{ $row->created_at->format('H:i') }} WIB</div>
                                            </td>

                                            <!-- Status -->
                                            <td class="text-center align-middle">
                                                @if ($row->is_published)
                                                    <span class="badge badge-success badge-pill px-3 py-1">Tayang</span>
                                                @else
                                                    <span class="badge badge-warning badge-pill px-3 py-1 text-dark">Draft</span>
                                                @endif
                                            </td>

                                            <!-- Action Buttons -->
                                            <td class="text-center align-middle">
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <a href="{{ route('admin.berita.show', $row->id) }}" class="btn btn-sm btn-info" title="Lihat Detail">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.berita.edit', $row->id) }}" class="btn btn-warning text-white" title="Edit Berita">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <!-- Trigger Hapus JS -->
                                                    <button type="button" class="btn btn-danger btn-delete-single" data-id="{{ $row->id }}" title="Hapus Berita">
                                                        <i class="fas fa-trash pointer-events-none"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted py-5">
                                                <i class="fas fa-newspaper fa-3x mb-3 text-black-50"></i>
                                                <h6 class="font-weight-bold text-secondary">Belum ada berita yang dipublikasikan.</h6>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </form>

                    <!-- Form tersembunyi untuk Hapus Single -->
                    <form id="form-delete-single" action="" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>

                @if ($berita->hasPages())
                    <div class="card-footer bg-white border-top py-3 d-flex flex-column flex-md-row align-items-center justify-content-between">
                        <span class="text-muted small mb-2 mb-md-0">
                            Menampilkan <strong>{{ $berita->firstItem() }}</strong> - <strong>{{ $berita->lastItem() }}</strong> dari <strong>{{ $berita->total() }}</strong> berita
                        </span>
                        <div>
                            {{ $berita->links() }}
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
        // Fungsi Select All Checkbox
        $('#checkAll').on('click', function() {
            $('.checkItem').prop('checked', $(this).prop('checked'));
            toggleBulkDeleteButton();
        });

        // Cek/uncek individu item
        $('.checkItem').on('change', function() {
            if ($('.checkItem:checked').length == $('.checkItem').length) {
                $('#checkAll').prop('checked', true);
            } else {
                $('#checkAll').prop('checked', false);
            }
            toggleBulkDeleteButton();
        });

        // Menampilkan atau menyembunyikan tombol Hapus Terpilih
        function toggleBulkDeleteButton() {
            let checkedCount = $('.checkItem:checked').length;
            if (checkedCount > 0) {
                $('#count-selected').text(checkedCount);
                $('#btn-bulk-delete').fadeIn(200);
            } else {
                $('#btn-bulk-delete').fadeOut(200);
            }
        }

        // Action submit Hapus Terpilih (Bulk Delete) dengan SweetAlert
        $('#btn-bulk-delete').on('click', function() {
            let count = $('.checkItem:checked').length;
            
            Swal.fire({
                title: 'Hapus ' + count + ' Berita?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus Masal!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#form-bulk-action').submit();
                }
            });
        });

        // Action submit Hapus Single dengan SweetAlert
        $('.btn-delete-single').on('click', function() {
            let id = $(this).data('id');
            // Pastikan prefix URL ini sesuai dengan environment Anda
            let url = "{{ url('admin/berita') }}/" + id;

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Berita ini akan dihapus secara permanen!",
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
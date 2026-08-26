@extends('layouts.master')

@section('title', 'Kelola Profil Perpustakaan - SIPERPUS')

@push('styles')
    
    <style>
        .card-modern {
            border: none !important;
            border-radius: 12px !important;
            box-shadow: 0 5px 15px rgba(0,0,0,0.03) !important;
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
        .nav-tabs-modern {
            border-bottom: 1px solid #e9ecef;
        }
        .nav-tabs-modern .nav-link {
            border: none;
            color: #6c757d;
            font-weight: 600;
            padding: 12px 20px;
            border-bottom: 2px solid transparent;
            transition: all 0.2s ease;
        }
        .nav-tabs-modern .nav-link.active {
            color: #007bff;
            border-bottom: 2px solid #007bff;
            background: transparent;
        }
        .form-control-modern {
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            padding: 10px 14px;
            transition: all 0.2s;
        }
        .form-control-modern:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
        }
        .note-editor.note-frame {
            border: 1px solid #e2e8f0 !important;
            border-radius: 8px !important;
            overflow: hidden;
        }
        .note-toolbar {
            background-color: #f8f9fa !important;
            border-bottom: 1px solid #e2e8f0 !important;
        }
    </style>
@endpush

@section('content')
<div class="content-wrapper bg-light">
    <!-- Header -->
    <div class="content-header pt-4 pb-3">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h4 class="m-0 font-weight-bold text-dark">Profil & Organisasi Perpustakaan</h4>
                    <p class="text-muted small mb-0">Kelola identitas publik, jam kerja, dan daftar pengurus perpustakaan.</p>
                </div>
                <div class="col-sm-6 text-sm-right mt-2 mt-sm-0">
                    <ol class="breadcrumb float-sm-right bg-transparent p-0 m-0 small">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Profil Perpustakaan</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <section class="content pb-5">
        <div class="container-fluid">

            <!-- Summary Cards -->
            <div class="row mb-4">
                <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
                    <div class="card card-modern p-3">
                        <div class="d-flex align-items-center">
                            <div class="stat-icon bg-primary-soft text-primary bg-light mr-3">
                                <i class="fas fa-users-cog fa-lg text-primary"></i>
                            </div>
                            <div>
                                <span class="text-muted small d-block font-weight-bold">TOTAL PENGURUS</span>
                                <h5 class="mb-0 font-weight-bold text-dark">{{ $pengurus->count() }} Orang</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
                    <div class="card card-modern p-3">
                        <div class="d-flex align-items-center">
                            <div class="stat-icon bg-success-soft text-success bg-light mr-3">
                                <i class="fas fa-clock fa-lg text-success"></i>
                            </div>
                            <div>
                                <span class="text-muted small d-block font-weight-bold">JAM OPERASIONAL</span>
                                <h6 class="mb-0 font-weight-bold text-dark">
                                    {{ $profil->jam_kerja_buka && $profil->jam_kerja_tutup ? $profil->jam_kerja_buka . ' - ' . $profil->jam_kerja_tutup : 'Belum Diatur' }}
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
                    <div class="card card-modern p-3">
                        <div class="d-flex align-items-center">
                            <div class="stat-icon bg-warning-soft text-warning bg-light mr-3">
                                <i class="fas fa-envelope fa-lg text-warning"></i>
                            </div>
                            <div class="overflow-hidden">
                                <span class="text-muted small d-block font-weight-bold">EMAIL RESMI</span>
                                <h6 class="mb-0 font-weight-bold text-dark text-truncate">{{ $profil->email ?? '-' }}</h6>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
                    <div class="card card-modern p-3">
                        <div class="d-flex align-items-center">
                            <div class="stat-icon bg-danger-soft text-danger bg-light mr-3">
                                <i class="fas fa-phone-alt fa-lg text-danger"></i>
                            </div>
                            <div>
                                <span class="text-muted small d-block font-weight-bold">TELEPON / WA</span>
                                <h6 class="mb-0 font-weight-bold text-dark">{{ $profil->telepon ?? '-' }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab Container -->
            <div class="card card-modern">
                <div class="card-header bg-white border-0 pt-3 px-4">
                    <ul class="nav nav-tabs nav-tabs-modern" id="profilTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="informasi-tab" data-toggle="tab" href="#informasi-pane" role="tab">
                                <i class="fas fa-building mr-2"></i>Informasi Umum & Kontak
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pengurus-tab" data-toggle="tab" href="#pengurus-pane" role="tab">
                                <i class="fas fa-sitemap mr-2"></i>Struktur Pengurus
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="card-body p-4">
                    <div class="tab-content" id="profilTabContent">

                        <!-- TAB 1: FORM PROFIL -->
                        <div class="tab-pane fade show active" id="informasi-pane" role="tabpanel">
                            <form action="{{ route('admin.profil.update') }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-6 form-group mb-3">
                                        <label class="font-weight-bold small text-dark">Nama Perpustakaan</label>
                                        <input type="text" name="nama_perpustakaan" class="form-control form-control-modern" value="{{ old('nama_perpustakaan', $profil->nama_perpustakaan) }}" required>
                                    </div>
                                    <div class="col-md-6 form-group mb-3">
                                        <label class="font-weight-bold small text-dark">Email Resmi</label>
                                        <input type="email" name="email" class="form-control form-control-modern" value="{{ old('email', $profil->email) }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 form-group mb-3">
                                        <label class="font-weight-bold small text-dark">Nomor Telepon / WhatsApp</label>
                                        <input type="text" name="telepon" class="form-control form-control-modern" value="{{ old('telepon', $profil->telepon) }}">
                                    </div>
                                    <div class="col-md-4 form-group mb-3">
                                        <label class="font-weight-bold small text-dark">Jam Buka</label>
                                        <input type="text" name="jam_kerja_buka" class="form-control form-control-modern" placeholder="07:00 WIB" value="{{ old('jam_kerja_buka', $profil->jam_kerja_buka) }}">
                                    </div>
                                    <div class="col-md-4 form-group mb-3">
                                        <label class="font-weight-bold small text-dark">Jam Tutup</label>
                                        <input type="text" name="jam_kerja_tutup" class="form-control form-control-modern" placeholder="15:00 WIB" value="{{ old('jam_kerja_tutup', $profil->jam_kerja_tutup) }}">
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="font-weight-bold small text-dark">Alamat Lengkap</label>
                                    <input type="text" name="alamat" class="form-control form-control-modern" value="{{ old('alamat', $profil->alamat) }}">
                                </div>

                                <div class="form-group mb-4">
                                    <label class="font-weight-bold small text-dark">Deskripsi Ringkas (Hero Section Website)</label>
                                    <textarea name="deskripsi_hero" class="form-control form-control-modern" rows="2">{{ old('deskripsi_hero', $profil->deskripsi_hero) }}</textarea>
                                </div>

                                <hr class="my-4">

                                <div class="form-group mb-4">
                                    <label class="font-weight-bold small text-dark mb-2">Sejarah Perpustakaan</label>
                                    <textarea name="sejarah" class="summernote">{{ old('sejarah', $profil->sejarah) }}</textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 form-group mb-4">
                                        <label class="font-weight-bold small text-dark mb-2">Visi & Misi</label>
                                        <textarea name="visi_misi" class="summernote">{{ old('visi_misi', $profil->visi_misi) }}</textarea>
                                    </div>
                                    <div class="col-md-6 form-group mb-4">
                                        <label class="font-weight-bold small text-dark mb-2">Tata Tertib & Layanan</label>
                                        <textarea name="tata_tertib" class="summernote">{{ old('tata_tertib', $profil->tata_tertib) }}</textarea>
                                    </div>
                                </div>

                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary px-4 rounded-pill font-weight-bold shadow-sm">
                                        <i class="fas fa-save mr-2"></i>Simpan Perubahan
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- TAB 2: DATA PENGURUS -->
                        <div class="tab-pane fade" id="pengurus-pane" role="tabpanel">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h6 class="font-weight-bold text-dark m-0">Daftar Pengurus Perpustakaan</h6>
                                <button type="button" class="btn btn-primary btn-sm rounded-pill px-3 font-weight-bold" data-toggle="modal" data-target="#modalTambahPengurus">
                                    <i class="fas fa-plus mr-1"></i> Tambah Pengurus
                                </button>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-hover align-middle border-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="border-0 text-muted small font-weight-bold text-center" width="10%">URUTAN</th>
                                            <th class="border-0 text-muted small font-weight-bold" width="35%">NAMA</th>
                                            <th class="border-0 text-muted small font-weight-bold" width="30%">JABATAN</th>
                                            <th class="border-0 text-muted small font-weight-bold text-center" width="12%">FOTO</th>
                                            <th class="border-0 text-muted small font-weight-bold text-center" width="13%">AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($pengurus as $row)
                                            <tr>
                                                <td class="text-center align-middle">
                                                    <span class="badge badge-light border px-2 py-1">#{{ $row->urutan }}</span>
                                                </td>
                                                <td class="align-middle font-weight-bold text-dark">{{ $row->nama }}</td>
                                                <td class="align-middle">
                                                    <span class="badge badge-info px-2 py-1 font-weight-normal">{{ $row->jabatan }}</span>
                                                </td>
                                                <td class="text-center align-middle">
                                                    @if ($row->foto)
                                                        <img src="{{ asset('storage/' . $row->foto) }}" alt="Foto" class="rounded-circle border" style="width: 38px; height: 38px; object-fit: cover;">
                                                    @else
                                                        <div class="bg-secondary text-white rounded-circle d-inline-flex align-items-center justify-content-center font-weight-bold" style="width: 38px; height: 38px; font-size: 0.85rem;">
                                                            {{ strtoupper(substr($row->nama, 0, 1)) }}
                                                        </div>
                                                    @endif
                                                </td>
                                                <td class="text-center align-middle">
                                                    <button type="button" class="btn btn-sm btn-outline-warning btn-edit-pengurus mr-1" 
                                                        data-id="{{ $row->id }}" 
                                                        data-nama="{{ $row->nama }}" 
                                                        data-jabatan="{{ $row->jabatan }}" 
                                                        data-urutan="{{ $row->urutan }}">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-outline-danger btn-delete-pengurus" 
                                                        data-id="{{ $row->id }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center py-5 text-muted">
                                                    <i class="fas fa-users-slash fa-2x mb-2 text-black-50 d-block"></i>
                                                    Belum ada data pengurus.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambahPengurus" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg rounded-lg">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title font-weight-bold small"><i class="fas fa-plus-circle mr-2"></i>Tambah Pengurus Baru</h5>
                <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form action="{{ route('admin.pengurus.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-4">
                    <div class="form-group mb-3">
                        <label class="small font-weight-bold">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control form-control-modern" required>
                    </div>
                    <div class="form-group mb-3">
                        <label class="small font-weight-bold">Jabatan</label>
                        <input type="text" name="jabatan" class="form-control form-control-modern" required>
                    </div>
                    <div class="form-group mb-3">
                        <label class="small font-weight-bold">Urutan Posisi</label>
                        <input type="number" name="urutan" class="form-control form-control-modern" value="1" required>
                    </div>
                    <div class="form-group mb-0">
                        <label class="small font-weight-bold">Foto (Opsional)</label>
                        <input type="file" name="foto" class="form-control-file" accept="image/*">
                    </div>
                </div>
                <div class="modal-footer bg-light border-0">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary font-weight-bold px-3">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="modalEditPengurus" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg rounded-lg">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title font-weight-bold small"><i class="fas fa-edit mr-2"></i>Edit Pengurus</h5>
                <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form id="formEditPengurus" action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body p-4">
                    <div class="form-group mb-3">
                        <label class="small font-weight-bold">Nama Lengkap</label>
                        <input type="text" name="nama" id="edit_nama" class="form-control form-control-modern" required>
                    </div>
                    <div class="form-group mb-3">
                        <label class="small font-weight-bold">Jabatan</label>
                        <input type="text" name="jabatan" id="edit_jabatan" class="form-control form-control-modern" required>
                    </div>
                    <div class="form-group mb-3">
                        <label class="small font-weight-bold">Urutan Posisi</label>
                        <input type="number" name="urutan" id="edit_urutan" class="form-control form-control-modern" required>
                    </div>
                    <div class="form-group mb-0">
                        <label class="small font-weight-bold">Ganti Foto (Opsional)</label>
                        <input type="file" name="foto" class="form-control-file" accept="image/*">
                    </div>
                </div>
                <div class="modal-footer bg-light border-0">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning text-white font-weight-bold px-3">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Hidden Delete Form -->
<form id="formDeletePengurus" action="" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endsection

@push('scripts')

    <script>
        $(document).ready(function() {
            // Summernote Inisialisasi
            $('.summernote').summernote({
                placeholder: 'Ketik teks di sini...',
                height: 220,
                toolbar: [
                    ['style', ['style', 'bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture', 'table']],
                    ['view', ['fullscreen', 'codeview']]
                ]
            });

            // Trigger Toast / Alert Sukses dari Session Laravel
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                    timer: 3000,
                    showConfirmButton: false
                });
            @endif

            // Trigger Edit Modal
            $('.btn-edit-pengurus').on('click', function() {
                let id = $(this).data('id');
                let nama = $(this).data('nama');
                let jabatan = $(this).data('jabatan');
                let urutan = $(this).data('urutan');

                $('#formEditPengurus').attr('action', "{{ url('admin/pengurus') }}/" + id);
                $('#edit_nama').val(nama);
                $('#edit_jabatan').val(jabatan);
                $('#edit_urutan').val(urutan);

                $('#modalEditPengurus').modal('show');
            });

            // SweetAlert2 Hapus Pengurus
            $('.btn-delete-pengurus').on('click', function() {
                let id = $(this).data('id');
                let actionUrl = "{{ url('admin/pengurus') }}/" + id;

                Swal.fire({
                    title: 'Hapus Pengurus?',
                    text: "Data pengurus ini akan dihapus permanen.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#formDeletePengurus').attr('action', actionUrl).submit();
                    }
                });
            });
        });
    </script>
@endpush
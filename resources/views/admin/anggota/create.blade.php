@extends('layouts.master')

@section('title', 'Tambah Anggota Baru - SIPERPUS')

@section('content')
<!-- Hapus class bg-light di sini agar background abu-abu standar AdminLTE kembali muncul, memberikan efek kedalaman pada Card -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header pt-4 pb-3">
        <div class="container-fluid">
            <div class="row mb-2 align-items-center">
                <div class="col-sm-6">
                    <h1 class="m-0 font-weight-bold text-dark">Tambah Pengguna Baru</h1>
                    <p class="text-muted small mb-0 mt-1">Lengkapi formulir di bawah ini untuk menambahkan pengguna ke dalam sistem.</p>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right bg-transparent p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.anggota.index') }}">Data Pengguna</a></li>
                        <li class="breadcrumb-item active">Tambah Data</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <!-- Membatasi lebar form pada layar besar agar tidak terlalu memanjang ke samping (col-lg-10) -->
                <div class="col-lg-10 col-md-12">
                    
                    <!-- Menggunakan card standard AdminLTE dengan garis atas biru (card-primary) dan card-outline -->
                    <div class="card card-primary card-outline shadow-sm mb-5">
                        
                        <form action="{{ route('admin.anggota.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="card-body p-4">
                                
                                <!-- ================= SECTION 1: AKUN ================= -->
                                <h5 class="text-primary font-weight-bold border-bottom pb-2 mb-4">
                                    <i class="fas fa-id-badge mr-2"></i> Informasi Akun
                                </h5>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Username <span class="text-danger">*</span></label>
                                            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" placeholder="Contoh: ahmad123" required>
                                            @error('username') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Alamat Email <span class="text-danger">*</span></label>
                                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Contoh: user@sekolah.sch.id" required>
                                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Role Akses <span class="text-danger">*</span></label>
                                            <select name="role" class="form-control @error('role') is-invalid @enderror" required>
                                                <option value="anggota" {{ old('role') == 'anggota' ? 'selected' : '' }}>Anggota Perpustakaan</option>
                                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrator</option>
                                            </select>
                                            @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- ================= SECTION 2: DATA DIRI ================= -->
                                <h5 class="text-primary font-weight-bold border-bottom pb-2 mb-4 mt-4">
                                    <i class="fas fa-user-circle mr-2"></i> Data Personal
                                </h5>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nama Lengkap <span class="text-danger">*</span></label>
                                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Masukkan nama lengkap sesuai identitas" required>
                                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>NIS / NIP</label>
                                            <input type="text" name="nis_nip" class="form-control @error('nis_nip') is-invalid @enderror" value="{{ old('nis_nip') }}" placeholder="Nomor Induk Siswa atau Pegawai (Opsional)">
                                            @error('nis_nip') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Tipe Anggota</label>
                                            <select name="tipe_anggota" class="form-control">
                                                <option value="">-- Pilih Tipe --</option>
                                                <option value="siswa" {{ old('tipe_anggota') == 'siswa' ? 'selected' : '' }}>Siswa</option>
                                                <option value="guru" {{ old('tipe_anggota') == 'guru' ? 'selected' : '' }}>Guru</option>
                                                <option value="staf" {{ old('tipe_anggota') == 'staf' ? 'selected' : '' }}>Staf</option>
                                                <option value="umum" {{ old('tipe_anggota') == 'umum' ? 'selected' : '' }}>Umum</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Jenis Kelamin</label>
                                            <select name="jenis_kelamin" class="form-control">
                                                <option value="">-- Pilih Kelamin --</option>
                                                <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                                <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Kelas</label>
                                            <input type="text" name="kelas" class="form-control" value="{{ old('kelas') }}" placeholder="Contoh: VII-A (Jika Siswa)">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="status" class="form-control">
                                                <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                                <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Non-Aktif</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>No. Telepon / WA</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                </div>
                                                <input type="text" name="no_telepon" class="form-control" value="{{ old('no_telepon') }}" placeholder="08xxxxxxxxxx">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Alamat Lengkap</label>
                                            <input type="text" name="alamat" class="form-control" value="{{ old('alamat') }}" placeholder="Nama jalan, RT/RW, Desa, Kecamatan">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mt-2">
                                    <label>Upload Foto Profil <small class="text-muted font-weight-normal">(Opsional)</small></label>
                                    <div class="custom-file">
                                        <input type="file" name="foto" class="custom-file-input @error('foto') is-invalid @enderror" id="customFile" accept="image/jpeg, image/png, image/jpg">
                                        <label class="custom-file-label" for="customFile">Pilih file dari perangkat Anda...</label>
                                    </div>
                                    <small class="text-muted mt-1 d-block"><i class="fas fa-info-circle mr-1"></i>Format yang diizinkan: JPG, JPEG, PNG. Ukuran maksimal 2MB.</small>
                                    @error('foto') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>

                                <!-- ================= SECTION 3: KATA SANDI ================= -->
                                <h5 class="text-primary font-weight-bold border-bottom pb-2 mb-4 mt-5">
                                    <i class="fas fa-key mr-2"></i> Pengaturan Keamanan
                                </h5>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Kata Sandi Baru <span class="text-danger">*</span></label>
                                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Minimal 8 karakter" required>
                                            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Konfirmasi Kata Sandi <span class="text-danger">*</span></label>
                                            <input type="password" name="password_confirmation" class="form-control" placeholder="Ketik ulang kata sandi di atas" required>
                                        </div>
                                    </div>
                                </div>

                            </div> <!-- /.card-body -->

                            <!-- Card Footer diletakkan terpisah dari body form -->
                            <div class="card-footer bg-light py-3 d-flex justify-content-between align-items-center">
                                <a href="{{ route('admin.anggota.index') }}" class="btn btn-default shadow-sm font-weight-bold">
                                    <i class="fas fa-arrow-left mr-1"></i> Kembali
                                </a>
                                <button type="submit" class="btn btn-primary shadow-sm font-weight-bold px-4">
                                    <i class="fas fa-save mr-1"></i> Simpan Anggota Baru
                                </button>
                            </div>
                        </form>
                    </div> <!-- /.card -->

                </div>
            </div>
        </div>
    </section>
</div>

<!-- Script untuk mengubah tulisan di upload file -->
@push('scripts')
<script>
    $(function () {
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    });
</script>
@endpush
@endsection
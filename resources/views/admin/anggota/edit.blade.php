@extends('layouts.master')

@section('title', 'Edit Anggota - SIPERPUS')

@section('content')
<div class="content-wrapper">
    <section class="content-header pt-4 pb-3">
        <div class="container-fluid">
            <div class="row mb-2 align-items-center">
                <div class="col-sm-6">
                    <h1 class="m-0 font-weight-bold text-dark">Edit Pengguna</h1>
                    <p class="text-muted small mb-0 mt-1">Perbarui informasi profil dan hak akses pengguna.</p>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right bg-transparent p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.anggota.index') }}">Data Pengguna</a></li>
                        <li class="breadcrumb-item active">Edit Data</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-12">
                    <div class="card card-primary card-outline shadow-sm mb-5">
                        
                        <!-- Perhatikan method dan tambahan @method('PUT') -->
                        <form action="{{ route('admin.anggota.update', $anggota->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <div class="card-body p-4">
                                
                                <!-- ================= SECTION 1: AKUN ================= -->
                                <h5 class="text-primary font-weight-bold border-bottom pb-2 mb-4">
                                    <i class="fas fa-id-badge mr-2"></i> Informasi Akun
                                </h5>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Username <span class="text-danger">*</span></label>
                                            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username', $anggota->username) }}" required>
                                            @error('username') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Alamat Email</label>
                                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $anggota->email) }}">
                                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Role Akses <span class="text-danger">*</span></label>
                                            <select name="role" class="form-control @error('role') is-invalid @enderror" required>
                                                <option value="anggota" {{ old('role', $anggota->role) == 'anggota' ? 'selected' : '' }}>Anggota Perpustakaan</option>
                                                <option value="admin" {{ old('role', $anggota->role) == 'admin' ? 'selected' : '' }}>Administrator</option>
                                            </select>
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
                                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $anggota->name) }}" required>
                                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>NIS / NIP</label>
                                            <input type="text" name="nis_nip" class="form-control @error('nis_nip') is-invalid @enderror" value="{{ old('nis_nip', $anggota->nis_nip) }}">
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
                                                <option value="siswa" {{ old('tipe_anggota', $anggota->tipe_anggota) == 'siswa' ? 'selected' : '' }}>Siswa</option>
                                                <option value="guru" {{ old('tipe_anggota', $anggota->tipe_anggota) == 'guru' ? 'selected' : '' }}>Guru</option>
                                                <option value="staf" {{ old('tipe_anggota', $anggota->tipe_anggota) == 'staf' ? 'selected' : '' }}>Staf</option>
                                                <option value="umum" {{ old('tipe_anggota', $anggota->tipe_anggota) == 'umum' ? 'selected' : '' }}>Umum</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Jenis Kelamin</label>
                                            <select name="jenis_kelamin" class="form-control">
                                                <option value="">-- Pilih --</option>
                                                <option value="L" {{ old('jenis_kelamin', $anggota->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                                <option value="P" {{ old('jenis_kelamin', $anggota->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Kelas</label>
                                            <input type="text" name="kelas" class="form-control" value="{{ old('kelas', $anggota->kelas) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="status" class="form-control">
                                                <option value="aktif" {{ old('status', $anggota->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                                <option value="nonaktif" {{ old('status', $anggota->status) == 'nonaktif' ? 'selected' : '' }}>Non-Aktif</option>
                                                <option value="lulus" {{ old('status', $anggota->status) == 'lulus' ? 'selected' : '' }}>Lulus</option>
                                                <option value="pindah" {{ old('status', $anggota->status) == 'pindah' ? 'selected' : '' }}>Pindah</option>
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
                                                <input type="text" name="no_telepon" class="form-control" value="{{ old('no_telepon', $anggota->no_telepon) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Alamat Lengkap</label>
                                            <input type="text" name="alamat" class="form-control" value="{{ old('alamat', $anggota->alamat) }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Foto Profil</label>
                                            <div class="d-flex align-items-center">
                                                <!-- Menampilkan foto lama jika ada -->
                                                <div class="mr-3">
                                                    @if($anggota->foto)
                                                        <img src="{{ asset('storage/' . $anggota->foto) }}" alt="Foto Profil" class="img-thumbnail" style="width: 80px; height: 80px; object-fit: cover;">
                                                    @else
                                                        <div class="bg-light border text-muted d-flex justify-content-center align-items-center rounded" style="width: 80px; height: 80px;">
                                                            <i class="fas fa-user fa-2x"></i>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="custom-file">
                                                        <input type="file" name="foto" class="custom-file-input @error('foto') is-invalid @enderror" id="customFile" accept="image/jpeg, image/png, image/jpg">
                                                        <label class="custom-file-label" for="customFile">Pilih untuk mengganti foto...</label>
                                                    </div>
                                                    <small class="text-muted d-block mt-1">Abaikan jika tidak ingin mengganti foto. Format: JPG, PNG. Maks: 2MB.</small>
                                                </div>
                                            </div>
                                            @error('foto') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- ================= SECTION 3: KATA SANDI ================= -->
                                <h5 class="text-primary font-weight-bold border-bottom pb-2 mb-4 mt-4">
                                    <i class="fas fa-key mr-2"></i> Pengaturan Keamanan
                                </h5>
                                
                                <div class="alert alert-info bg-light border-info text-info small">
                                    <i class="fas fa-info-circle mr-1"></i> Biarkan kosong jika Anda tidak ingin mengubah kata sandi saat ini.
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Kata Sandi Baru</label>
                                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Minimal 8 karakter">
                                            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Konfirmasi Kata Sandi Baru</label>
                                            <input type="password" name="password_confirmation" class="form-control" placeholder="Ketik ulang kata sandi">
                                        </div>
                                    </div>
                                </div>

                            </div> <!-- /.card-body -->

                            <div class="card-footer bg-light py-3 d-flex justify-content-between align-items-center">
                                <a href="{{ route('admin.anggota.index') }}" class="btn btn-default shadow-sm font-weight-bold">
                                    <i class="fas fa-arrow-left mr-1"></i> Batal
                                </a>
                                <button type="submit" class="btn btn-success shadow-sm font-weight-bold px-4">
                                    <i class="fas fa-save mr-1"></i> Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div> 
                </div>
            </div>
        </div>
    </section>
</div>

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
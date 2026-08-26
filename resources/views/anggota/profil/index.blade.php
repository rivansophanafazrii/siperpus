@extends('layouts.master')

@section('title', 'Profil Saya - SIPERPUS')

@section('content')
    <div class="content-wrapper bg-light">
        <!-- Content Header -->
        <div class="content-header pt-4 pb-3">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h3 class="m-0 font-weight-bold text-dark">Profil Saya</h3>
                        <p class="text-muted small mb-0">Kelola informasi data diri dan kata sandi Anda.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <section class="content">
            <div class="container-fluid">

                <div class="row">
                    <!-- Kolom Kiri: Foto & Identitas Singkat -->
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm rounded-lg mb-4">
                            <div class="card-body text-center p-4">
                                <div class="mb-3">
                                    @if ($user->foto)
                                        <img src="{{ asset('storage/' . $user->foto) }}" alt="Foto Profil"
                                            class="img-circle elevation-2"
                                            style="width: 150px; height: 150px; object-fit: cover;">
                                    @else
                                        <div class="bg-primary text-white img-circle elevation-2 d-inline-flex align-items-center justify-content-center"
                                            style="width: 150px; height: 150px; font-size: 4rem;">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                    @endif
                                </div>
                                <h4 class="font-weight-bold mb-0">{{ $user->name }}</h4>
                                <p class="text-muted mb-2">{{ $user->nis_nip ?? '@' . $user->username }}</p>
                                <span
                                    class="badge badge-info text-capitalize px-3 py-1">{{ $user->tipe_anggota ?? 'Anggota' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Kolom Kanan: Form Update -->
                    <div class="col-md-8">
                        <div class="card border-0 shadow-sm rounded-lg mb-5">
                            <div class="card-header bg-white border-0 py-3">
                                <h5 class="font-weight-bold text-dark mb-0"><i
                                        class="fas fa-user-edit text-primary mr-2"></i> Edit Data Diri</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label text-md-right">Username <span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="username"
                                                class="form-control @error('username') is-invalid @enderror"
                                                value="{{ old('username', $user->username) }}" required>
                                            @error('username')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label text-md-right">Nama Lengkap <span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="name"
                                                class="form-control @error('name') is-invalid @enderror"
                                                value="{{ old('name', $user->name) }}" required>
                                            @error('name')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label text-md-right">Alamat Email <span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="email" name="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                value="{{ old('email', $user->email) }}" required>
                                            @error('email')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label text-md-right">No. Telepon / WA</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="no_telepon"
                                                class="form-control @error('no_telepon') is-invalid @enderror"
                                                value="{{ old('no_telepon', $user->no_telepon) }}"
                                                placeholder="Contoh: 08123456789">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label text-md-right">Foto Profil</label>
                                        <div class="col-sm-9">
                                            <div class="custom-file">
                                                <input type="file" name="foto"
                                                    class="custom-file-input @error('foto') is-invalid @enderror"
                                                    id="customFile" accept="image/png, image/jpeg, image/jpg">
                                                <label class="custom-file-label" for="customFile">Pilih file foto
                                                    baru...</label>
                                            </div>
                                            <small class="form-text text-muted">Format: JPG, JPEG, PNG. Maksimal 2MB.
                                                Kosongkan jika tidak ingin mengubah foto.</small>
                                            @error('foto')
                                                <span class="text-danger small">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <hr class="my-4">
                                    <h6 class="font-weight-bold text-dark mb-3"><i
                                            class="fas fa-lock text-warning mr-2"></i> Ubah Kata Sandi (Opsional)</h6>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label text-md-right">Password Baru</label>
                                        <div class="col-sm-9">
                                            <input type="password" name="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                placeholder="Minimal 8 karakter">
                                            <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah
                                                password.</small>
                                            @error('password')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label text-md-right">Ulangi Password</label>
                                        <div class="col-sm-9">
                                            <input type="password" name="password_confirmation" class="form-control"
                                                placeholder="Ketik ulang password baru">
                                        </div>
                                    </div>

                                    <div class="form-group row mt-4">
                                        <div class="col-sm-9 offset-sm-3">
                                            <button type="submit" class="btn btn-primary px-4 font-weight-bold">
                                                <i class="fas fa-save mr-1"></i> Simpan Perubahan
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script>
        // Script untuk memunculkan nama file saat diunggah pada input custom-file Bootstrap
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    </script>
@endpush

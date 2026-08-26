@extends('layouts.front')

@section('content')
    <style>
        /* CSS Khusus untuk halaman Survei Kebutuhan yang tidak ada di layout utama */
        .page-hero-container {
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.92), rgba(37, 99, 235, 0.85)), url('https://images.unsplash.com/photo-1521587760476-6c12a4b040da?auto=format&fit=crop&w=1920&q=80') center/cover no-repeat;
            padding: 8rem 0 7rem 0;
            border-radius: 0 0 48px 48px;
            margin-bottom: 2rem;
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.15);
        }

        .page-title {
            color: #ffffff;
            font-weight: 800;
            letter-spacing: -0.75px;
        }

        .page-subtitle {
            color: rgba(255, 255, 255, 0.85);
            font-size: 1.1rem;
            max-width: 650px;
            line-height: 1.7;
        }

        .page-icon-box-hero {
            width: 85px;
            height: 85px;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            color: #ffffff;
            border-radius: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.2rem;
            margin: 0 auto 1.5rem auto;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .form-control-lg,
        .form-select-lg {
            border-radius: 16px;
            padding: 0.8rem 1.2rem;
            font-size: 0.95rem;
            border: 1px solid rgba(226, 232, 240, 0.8);
            background-color: var(--color-background);
            transition: var(--transition-smooth);
        }

        .form-control-lg:focus,
        .form-select-lg:focus {
            background-color: var(--color-surface);
            border-color: var(--color-primary);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }
    </style>

    <!-- Header Halaman Survei -->
    <section class="page-hero-container bg-grid-pattern">
        <div class="container text-center">
            <div class="page-icon-box-hero shadow-sm mb-4 floating-element">
                <i class="fas fa-clipboard"></i>
            </div>
            <h1 class="display-5 page-title mb-3">Survei Kebutuhan Pustaka</h1>
            <p class="page-subtitle mx-auto">
                Usulkan judul buku atau bahan pustaka yang Anda perlukan untuk pengadaan perpustakaan selanjutnya.
            </p>
        </div>
    </section>

    <!-- Form Survei -->
    <section class="section-padding pt-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">

                    {{-- Notifikasi Sukses --}}
                    @if (session('success_survei'))
                        <div class="alert alert-success alert-dismissible fade show shadow-sm rounded-4 mb-4 border-0 p-4"
                            role="alert" style="background-color: #d1fae5; color: #065f46;">
                            <div class="d-flex align-items-center">
                                <i class="fa-solid fa-circle-check fs-2 me-3"></i>
                                <div>
                                    <strong class="d-block fs-5 mb-1">Usulan Terkirim!</strong>
                                    {{ session('success_survei') }}
                                </div>
                            </div>
                            <button type="button" class="btn-close mt-2" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="modern-card p-4 p-md-5">
                        <div class="text-center mb-4 pb-2">
                            <h3 class="fw-bold text-dark mb-2">Form Usulan Buku Baru</h3>
                            <p class="text-muted">Isi detail buku yang Anda butuhkan secara lengkap.</p>
                        </div>

                        <form action="{{ route('survei-kebutuhan.store') }}" method="POST">
                            @csrf

                            <div class="row g-4 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Nama Lengkap Pemohon <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="nama"
                                        class="form-control form-control-lg @error('nama') is-invalid @enderror"
                                        placeholder="Masukkan nama Anda" value="{{ old('nama') }}" required>
                                    @error('nama')
                                        <div class="text-danger mt-1 small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Status / Peran</label>
                                    <select name="peran"
                                        class="form-select form-select-lg @error('peran') is-invalid @enderror">
                                        <option value="Siswa" {{ old('peran') == 'Siswa' ? 'selected' : '' }}>Siswa
                                        </option>
                                        <option value="Guru" {{ old('peran') == 'Guru' ? 'selected' : '' }}>Guru</option>
                                        <option value="Staf / Karyawan"
                                            {{ old('peran') == 'Staf / Karyawan' ? 'selected' : '' }}>Staf / Karyawan
                                        </option>
                                        <option value="Umum" {{ old('peran') == 'Umum' ? 'selected' : '' }}>Masyarakat
                                            Umum</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row g-4 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Judul Buku Yang Diusulkan <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="judul_buku"
                                        class="form-control form-control-lg @error('judul_buku') is-invalid @enderror"
                                        placeholder="Tuliskan judul buku lengkap" value="{{ old('judul_buku') }}" required>
                                    @error('judul_buku')
                                        <div class="text-danger mt-1 small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Pengarang / Penerbit</label>
                                    <input type="text" name="pengarang"
                                        class="form-control form-control-lg @error('pengarang') is-invalid @enderror"
                                        placeholder="Contoh: Andrea Hirata (Opsional)" value="{{ old('pengarang') }}">
                                </div>
                            </div>

                            <div class="mb-5">
                                <label class="form-label fw-bold">Alasan / Alasan Kebutuhan Buku</label>
                                <textarea name="alasan" rows="4" class="form-control form-control-lg @error('alasan') is-invalid @enderror"
                                    placeholder="Mengapa buku ini perlu disediakan di perpustakaan? (Contoh: Bahan acuan tugas, referensi ujian, dll)">{{ old('alasan') }}</textarea>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end border-top pt-4">
                                <a href="/" class="btn btn-light fw-bold py-2 px-4 rounded-pill"
                                    style="border: 2px solid #e2e8f0; color: #64748b;">
                                    Kembali
                                </a>
                                <button type="submit" class="btn-modern-primary py-2 px-5">
                                    <i class="fa-solid fa-paper-plane"></i> Kirim Usulan Buku
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

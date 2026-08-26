@extends('layouts.front')

@section('content')
    <style>
        /* CSS Khusus untuk halaman Buku Tamu yang tidak ada di layout utama */
        /* Penyesuaian Halaman Statis Selaras dengan Landing Page */
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

    <!-- Header Halaman Buku Tamu -->
    <section class="page-hero-container bg-grid-pattern">
        <div class="container text-center">
            <div class="page-icon-box-hero shadow-sm mb-4 floating-element">
                <i class="fas fa-book-open"></i>
            </div>
            <h1 class="display-5 page-title mb-3">Buku Tamu Digital</h1>
            <p class="page-subtitle mx-auto">
                Pendataan presensi kunjungan pemustaka Perpustakaan SMPN 2 Kadugede.
            </p>
        </div>
    </section>

    <!-- Form Buku Tamu -->
    <section class="section-padding pt-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">

                    {{-- Notifikasi Sukses --}}
                    @if (session('success_buku_tamu'))
                        <div class="alert alert-success alert-dismissible fade show shadow-sm rounded-4 mb-4 border-0 p-4"
                            role="alert" style="background-color: #d1fae5; color: #065f46;">
                            <div class="d-flex align-items-center">
                                <i class="fa-solid fa-circle-check fs-2 me-3"></i>
                                <div>
                                    <strong class="d-block fs-5 mb-1">Berhasil Disimpan!</strong>
                                    {{ session('success_buku_tamu') }}
                                </div>
                            </div>
                            <button type="button" class="btn-close mt-2" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="modern-card p-4 p-md-5">
                        <div class="text-center mb-4 pb-2">
                            <h3 class="fw-bold text-dark mb-2">Formulir Kunjungan</h3>
                            <p class="text-muted">Silakan lengkapi data diri Anda di bawah ini.</p>
                        </div>

                        <form action="{{ route('buku-tamu.store') }}" method="POST">
                            @csrf

                            <div class="row g-4 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Nama Lengkap <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-transparent border-end-0 text-muted"
                                            style="border-radius: 16px 0 0 16px;"><i class="fa-regular fa-user"></i></span>
                                        <input type="text" name="nama"
                                            class="form-control form-control-lg border-start-0 ps-0 @error('nama') is-invalid @enderror"
                                            placeholder="Masukkan nama Anda" value="{{ old('nama') }}" required>
                                    </div>
                                    @error('nama')
                                        <div class="text-danger mt-1 small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Kelas / Instansi</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-transparent border-end-0 text-muted"
                                            style="border-radius: 16px 0 0 16px;"><i
                                                class="fa-regular fa-building"></i></span>
                                        <input type="text" name="kelas_instansi"
                                            class="form-control form-control-lg border-start-0 ps-0 @error('kelas_instansi') is-invalid @enderror"
                                            placeholder="Contoh: VII-A atau Umum" value="{{ old('kelas_instansi') }}">
                                    </div>
                                    <div class="form-text small mt-1">Kosongkan jika tidak perlu.</div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Tujuan Kunjungan <span
                                        class="text-danger">*</span></label>
                                <select name="tujuan"
                                    class="form-select form-select-lg @error('tujuan') is-invalid @enderror" required>
                                    <option value="" disabled selected>-- Pilih Tujuan Anda --</option>
                                    <option value="Membaca Buku" {{ old('tujuan') == 'Membaca Buku' ? 'selected' : '' }}>
                                        Membaca Buku</option>
                                    <option value="Meminjam Buku" {{ old('tujuan') == 'Meminjam Buku' ? 'selected' : '' }}>
                                        Meminjam Buku</option>
                                    <option value="Mengembalikan Buku"
                                        {{ old('tujuan') == 'Mengembalikan Buku' ? 'selected' : '' }}>Mengembalikan Buku
                                    </option>
                                    <option value="Mengerjakan Tugas"
                                        {{ old('tujuan') == 'Mengerjakan Tugas' ? 'selected' : '' }}>Mengerjakan Tugas
                                    </option>
                                    <option value="Studi Banding / Kunjungan Dinas"
                                        {{ old('tujuan') == 'Studi Banding / Kunjungan Dinas' ? 'selected' : '' }}>Studi
                                        Banding / Kunjungan Dinas</option>
                                    <option value="Lainnya" {{ old('tujuan') == 'Lainnya' ? 'selected' : '' }}>Lainnya
                                    </option>
                                </select>
                                @error('tujuan')
                                    <div class="text-danger mt-1 small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-5">
                                <label class="form-label fw-bold">Pesan / Keterangan Tambahan</label>
                                <textarea name="keterangan" rows="4"
                                    class="form-control form-control-lg @error('keterangan') is-invalid @enderror"
                                    placeholder="Tuliskan pesan, kesan, atau keterangan tambahan (Opsional)">{{ old('keterangan') }}</textarea>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end border-top pt-4">
                                <a href="/" class="btn btn-light fw-bold py-2 px-4 rounded-pill"
                                    style="border: 2px solid #e2e8f0; color: #64748b;">
                                    Kembali
                                </a>
                                <button type="submit" class="btn-modern-primary py-2 px-5">
                                    <i class="fa-solid fa-paper-plane"></i> Kirim Data Kunjungan
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

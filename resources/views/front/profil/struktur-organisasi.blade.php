@extends('layouts.front')

@section('content')
    <style>
        /* Penyesuaian Halaman Statis Selaras dengan Landing Page */
        .profile-hero-container {
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.92), rgba(37, 99, 235, 0.85)), url('https://images.unsplash.com/photo-1521587760476-6c12a4b040da?auto=format&fit=crop&w=1920&q=80') center/cover no-repeat;
            padding: 8rem 0 7rem 0;
            border-radius: 0 0 48px 48px;
            margin-bottom: 2rem;
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.15);
        }

        .profile-title {
            color: #ffffff;
            font-weight: 800;
            letter-spacing: -0.75px;
        }

        .profile-subtitle {
            color: rgba(255, 255, 255, 0.85);
            font-size: 1.1rem;
            max-width: 650px;
            line-height: 1.7;
        }

        .profile-icon-box-hero {
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

        .content-box {
            background-color: var(--color-surface, #ffffff);
            border: 1px solid rgba(226, 232, 240, 0.8);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            border-radius: var(--radius-card, 28px);
        }

        /* Styling tambahan untuk Card Pengurus */
        .pengurus-card {
            border: 1px solid rgba(226, 232, 240, 0.8);
            transition: all 0.3s ease;
            background-color: #f8fafc;
        }

        .pengurus-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1) !important;
            background-color: #ffffff;
            border-color: var(--color-primary, #2563eb);
        }

        /* Garis penghubung hierarki */
        .hierarchy-line {
            height: 35px;
            width: 2px;
            background-color: rgba(37, 99, 235, 0.3);
            /* Warna biru muda */
            margin: 0 auto;
        }
    </style>

    <!-- Hero Section -->
    <section class="profile-hero-container bg-grid-pattern">
        <div class="container text-center">
            <div class="profile-icon-box-hero shadow-sm mb-4 floating-element">
                <i class="fa-solid fa-sitemap"></i>
            </div>
            <h1 class="display-5 profile-title mb-3">Struktur Organisasi</h1>
            <p class="profile-subtitle mx-auto">
                Susunan kepengurusan dan pustakawan yang berdedikasi melayani Anda sepenuh hati.
            </p>
        </div>
    </section>

    <!-- Konten Utama (Melayang di atas Hero) -->
    <div class="container pb-5" style="margin-top: -65px; position: relative; z-index: 10;">
        <div class="row justify-content-center">
            <div class="col-lg-10 content-box p-4 p-md-5">

                <!-- Mengurutkan dan mengelompokkan data berdasarkan field 'urutan' -->
                @php
                    // Pastikan collection diurutkan (sortBy) angka urutan terkecil ke terbesar
                    // Lalu dikelompokkan (groupBy) berdasarkan angka urutan yang sama
                    $groupedPengurus = $pengurus->sortBy('urutan')->groupBy('urutan');
                    $loopCount = 0;
                @endphp

                @forelse($groupedPengurus as $urutan => $anggota)
                    <div class="hierarchy-section">
                        <!-- Judul Tingkatan Jabatan
                                 (Kita ambil nama jabatan dari orang pertama di grup urutan ini)
    -->
                        <div class="text-center mb-4">
                            <h6 class="fw-bold mb-2 text-uppercase"
                                style="color: var(--color-primary, #2563eb); letter-spacing: 1px;">
                                {{ $anggota->first()->jabatan }}
                            </h6>
                            <div class="bg-primary bg-opacity-25 mx-auto" style="height: 2px; width: 60px;"></div>
                        </div>

                        <!-- Baris Anggota pada Tingkatan Urutan tersebut -->
                        <div class="row justify-content-center g-4">
                            @foreach ($anggota as $p)
                                <div class="col-10 col-sm-6 col-md-4 col-lg-3">
                                    <div class="card h-100 pengurus-card shadow-sm rounded-4 p-4 text-center">
                                        <!-- Foto Profil -->
                                        <div class="mb-3 position-relative d-inline-block">
                                            @if ($p->foto)
                                                <img src="{{ asset('storage/' . $p->foto) }}" alt="{{ $p->nama }}"
                                                    class="rounded-circle shadow-sm"
                                                    style="width: 100px; height: 100px; object-fit: cover; border: 4px solid #ffffff;">
                                            @else
                                                <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-inline-flex align-items-center justify-content-center shadow-sm"
                                                    style="width: 100px; height: 100px; font-size: 2.5rem; font-weight: bold; border: 4px solid #ffffff;">
                                                    {{ strtoupper(substr($p->nama, 0, 1)) }}
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Informasi Nama & Jabatan (Opsional jika ingin tetap ditampilkan di bawah nama) -->
                                        <h6 class="fw-bold text-dark mb-1" style="font-size: 1rem;">{{ $p->nama }}</h6>
                                        <p class="text-muted small mb-0">{{ $p->jabatan }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    @php $loopCount++; @endphp
                    <!-- Tambahkan garis vertikal pembatas jika bukan grup urutan yang terakhir -->
                    @if ($loopCount < count($groupedPengurus))
                        <div class="hierarchy-line my-3"></div>
                    @endif

                @empty
                    <!-- Jika data kosong -->
                    <div class="col-12 text-center py-5">
                        <i class="fa-solid fa-users fa-3x mb-3 text-secondary opacity-50"></i>
                        <p class="text-muted mb-0">Belum ada data struktur organisasi atau kepengurusan yang ditambahkan.
                        </p>
                    </div>
                @endforelse

                <!-- Tombol Navigasi Bawah -->
                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-5 pt-4 border-top gap-3"
                    style="border-color: rgba(226, 232, 240, 0.8) !important;">
                    <a href="{{ url('/') }}" class="btn btn-outline-secondary rounded-pill fw-bold"
                        style="padding: 0.6rem 1.5rem;">
                        <i class="fa-solid fa-arrow-left"></i> Kembali Ke Beranda
                    </a>
                </div>

            </div>
        </div>
    </div>
@endsection

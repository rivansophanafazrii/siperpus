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

        .profile-content {
            line-height: 1.8;
            font-size: 1.05rem;
            color: var(--color-text-main, #334155);
        }
    </style>

    <!-- Hero Section -->
    <section class="profile-hero-container bg-grid-pattern">
        <div class="container text-center">
            <!-- Ikon Sasaran/Target (Visi Misi) -->
            <div class="profile-icon-box-hero shadow-sm mb-4 floating-element">
                <i class="fa-solid fa-bullseye"></i>
            </div>
            <h1 class="display-5 profile-title mb-3">Visi dan Misi</h1>
            <p class="profile-subtitle mx-auto">
                Arah, tujuan, dan komitmen kami dalam membangun budaya literasi yang unggul.
            </p>
        </div>
    </section>

    <!-- Konten Utama (Melayang di atas Hero) -->
    <div class="container pb-5" style="margin-top: -65px; position: relative; z-index: 10;">
        <div class="row justify-content-center">
            <div class="col-lg-9 content-box p-4 p-md-5">

                <div class="profile-content">
                    @if (isset($profil) && $profil->visi_misi)
                        {!! $profil->visi_misi !!}
                    @else
                        <div class="text-center py-5 text-muted">
                            <i class="fa-solid fa-file-circle-xmark fa-3x mb-3 text-secondary opacity-50"></i>
                            <p class="mb-0">Data visi dan misi belum ditambahkan oleh Admin.</p>
                        </div>
                    @endif
                </div>

                <!-- Tombol Navigasi Bawah -->
                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center mt-5 pt-4 border-top gap-3"
                    style="border-color: rgba(226, 232, 240, 0.8) !important;">
                    <a href="{{ url('/') }}" class="btn btn-outline-secondary rounded-pill fw-bold"
                        style="padding: 0.6rem 1.5rem;">
                        <i class="fa-solid fa-arrow-left"></i> Kembali Ke Beranda
                    </a>

                    <a href="{{ route('opac.index') }}" class="btn btn-primary rounded-pill fw-bold shadow-sm"
                        style="padding: 0.6rem 1.5rem;">
                        Jelajahi Koleksi <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>
@endsection

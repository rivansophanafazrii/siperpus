<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | SIPERPUS</title>

    {{-- favicon --}}
    <link rel="icon" type="image/png" href="/images/favicon.png">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --color-primary: #2563EB;
            --color-primary-dark: #1D4ED8;
            --color-surface: #FFFFFF;
            --color-background: #F8FAFC;
            --color-text-main: #0F172A;
            --color-text-muted: #64748B;
            --radius-card: 28px;
            --radius-pill: 50px;
            --shadow-soft: 0 12px 35px -8px rgba(37, 99, 235, 0.08);
            --transition-smooth: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--color-background);
            color: var(--color-text-main);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        .login-wrapper {
            width: 100%;
            max-width: 1100px;
            background: var(--color-surface);
            border-radius: var(--radius-card);
            box-shadow: 0 25px 50px -12px rgba(37, 99, 235, 0.15);
            overflow: hidden;
            border: 1px solid rgba(226, 232, 240, 0.8);
            margin: 1.5rem;
        }

        .login-banner {
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.95), rgba(37, 99, 235, 0.90)), url('https://images.unsplash.com/photo-1521587760476-6c12a4b040da?auto=format&fit=crop&w=1000&q=80') center/cover no-repeat;
            color: white;
            padding: 4rem 3rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 550px;
        }

        .login-form-container {
            padding: 4rem 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .brand-logo-login {
            font-weight: 800;
            font-size: 1.6rem;
            color: white;
            text-decoration: none;
            letter-spacing: -0.5px;
        }

        .brand-dot {
            color: #38BDF8;
        }

        .form-control-modern {
            background: var(--color-background);
            border: 1px solid rgba(226, 232, 240, 0.8);
            border-radius: var(--radius-pill);
            padding: 0.8rem 1.25rem 0.8rem 3.2rem;
            font-size: 0.95rem;
            font-weight: 500;
            color: var(--color-text-main);
            transition: var(--transition-smooth);
            box-shadow: none !important;
        }

        .form-control-modern:focus {
            background: white;
            border-color: var(--color-primary);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1) !important;
        }

        .input-group-icon {
            position: absolute;
            left: 1.25rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--color-text-muted);
            z-index: 10;
        }

        .btn-modern-primary {
            background: linear-gradient(135deg, #2563EB, #1D4ED8);
            color: white;
            font-weight: 700;
            padding: 0.85rem 1.8rem;
            border-radius: var(--radius-pill);
            border: none;
            box-shadow: 0 10px 25px -5px rgba(37, 99, 235, 0.4);
            transition: var(--transition-smooth);
            font-size: 0.95rem;
            text-decoration: none;
            width: 100%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        /* Animasi Melayang */
        @keyframes floatBlob {
            0% {
                transform: translateY(0px) rotate(0deg) scale(1);
            }

            100% {
                transform: translateY(-25px) rotate(12deg) scale(1.08);
            }
        }

        @keyframes floatBadge {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-8px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .floating-element {
            animation: floatBadge 4s ease-in-out infinite;
        }

        .btn-modern-primary:hover {
            background: linear-gradient(135deg, #1D4ED8, #1E40AF);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 15px 30px -5px rgba(37, 99, 235, 0.6);
        }

        @media (max-width: 991.98px) {
            .login-banner {
                padding: 3rem 2rem;
                min-height: auto;
            }

            .login-form-container {
                padding: 3rem 2rem;
            }
        }
    </style>
</head>

<body>

    <div class="login-wrapper">
        <div class="row g-0">
            <!-- Sisi Kiri: Banner & Informasi -->
            <div class="col-lg-6 login-banner">
                <a class="brand-logo d-flex align-items-center text-decoration-none gap-2" href="{{ route('home') }}">
                    <!-- Ubah path src sesuai lokasi file logo Anda -->
                    <img src="{{ asset('images/logo.png') }}" alt="Logo siperpus"
                        style="height: 40px; object-fit: contain;">
                    <span class="fw-bold text-white fs-4">SIPERPUS<span class="brand-dot text-primary">.</span></span>
                </a>
                <div class="my-auto py-4">
                    <div class="mb-4 floating-element"
                        style="width: 64px; height: 64px; background: rgba(255,255,255,0.1); border-radius: 20px; display: flex; align-items: center; justify-content: center; backdrop-filter: blur(8px);">
                        <i class="fa-solid fa-book-bookmark fs-3 text-white"></i>
                    </div>
                    <h2 class="fw-bold mb-3" style="letter-spacing: -1px; font-size: 2.25rem; line-height: 1.2;">SELAMAT
                        DATANG DI SIPERPUS SMPN 2 KADUGEDE</h2>
                    <p class="text-light opacity-85 mb-0" style="line-height: 1.7; font-size: 1.02rem;">
                        Akses ribuan koleksi buku, pantau riwayat peminjaman, dan nikmati layanan literasi digital kami
                        secara terpadu.
                    </p>
                </div>
                {{-- <div>
                    <p class="text-light opacity-75 mb-0" style="font-size: 0.85rem;">Copyright &copy; {{ date('Y') }} Kelompok 3. Hak Cipta Dilindungi.</p>
                </div> --}}
            </div>

            <!-- Sisi Kanan: Form Login -->
            <div class="col-lg-6 login-form-container">
                <div class="mb-4">
                    <!-- Notifikasi Sukses (Misal setelah logout) -->
                    @if (session('success'))
                        <div class="alert alert-success text-center shadow-sm">
                            {{ session('success') }}
                        </div>
                    @endif
                    <h3 class="fw-bold text-dark mb-1" style="letter-spacing: -0.5px;">MASUK KE AKUN</h3>
                    <p class="text-muted" style="font-size: 0.92rem;">Silahkan masukan informasi login anda untuk akses
                        dashboard.</p>
                </div>

                <!-- Notifikasi Error Jika Login Gagal -->
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show rounded-4 mb-3" role="alert"
                        style="font-size: 0.88rem;">
                        <i class="fa-solid fa-circle-exclamation me-1"></i>
                        {{ $errors->first() }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('login.post') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-bold text-dark" style="font-size: 0.88rem;">Username</label>
                        <div class="position-relative">
                            <i class="fa-solid fa-user input-group-icon"></i>
                            <input type="text" name="username"
                                class="form-control form-control-modern @error('username') is-invalid @enderror"
                                placeholder="Username / NIS / NIP" value="{{ old('username') }}" required autofocus>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold text-dark" style="font-size: 0.88rem;">Password</label>
                        <div class="position-relative">
                            <i class="fa-solid fa-lock input-group-icon"></i>
                            <input type="password" name="password" class="form-control form-control-modern"
                                placeholder="Masukan Password" required>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input type="checkbox" name="remember" class="form-check-input" id="rememberMe">
                            <label class="form-check-label text-muted" for="rememberMe"
                                style="font-size: 0.88rem; font-weight: 500;">Ingat Saya</label>
                        </div>
                    </div>

                    <button type="submit" class="btn-modern-primary mb-4">MASUK</button>

                    <div class="text-center">
                        <p class="text-muted mb-0" style="font-size: 0.88rem; font-weight: 500;">
                            Belum memiliki akun? <a href="#" class="text-decoration-none fw-bold"
                                style="color: var(--color-primary);">[Hubungi Admin Perpustakaan]</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

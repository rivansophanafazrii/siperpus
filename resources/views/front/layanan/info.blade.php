@extends('layouts.front')

@section('content')
    <style>
        /* Penyesuaian Halaman Statis Selaras dengan Landing Page */
        .service-hero-container {
            /* Gradien biru/ungu dan gambar latar dari landing page */
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.92), rgba(37, 99, 235, 0.85)), url('https://images.unsplash.com/photo-1521587760476-6c12a4b040da?auto=format&fit=crop&w=1920&q=80') center/cover no-repeat;
            padding: 8rem 0 7rem 0;
            border-radius: 0 0 48px 48px;
            margin-bottom: 2rem;
            box-shadow: 0 20px 40px rgba(15, 23, 42, 0.15);
        }

        .service-title {
            color: #ffffff;
            font-weight: 800;
            letter-spacing: -0.75px;
        }

        .service-subtitle {
            color: rgba(255, 255, 255, 0.85);
            font-size: 1.1rem;
            max-width: 650px;
            line-height: 1.7;
        }

        /* Kotak ikon disesuaikan bergaya kaca transparan (glassmorphism) */
        .service-icon-box-hero {
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

        /* Gaya untuk box konten putih di bawah hero */
        .content-box {
            background-color: var(--color-surface, #ffffff);
            border: 1px solid rgba(226, 232, 240, 0.8);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            border-radius: var(--radius-card, 28px);
        }

        .service-content {
            line-height: 1.8;
            font-size: 1.05rem;
            color: var(--color-text-main, #334155);
        }

        .service-content ul {
            list-style-type: disc;
            padding-left: 1.5rem;
            color: var(--color-text-muted, #64748b);
        }

        .service-content ul li {
            margin-bottom: 0.8rem;
        }
    </style>

    <!-- Pahlawan Visual (Hero Section) -->
    <section class="service-hero-container bg-grid-pattern">
        <div class="container text-center">
            <!-- Ikon Layanan (Informasi Umum) -->
            <div class="service-icon-box-hero shadow-sm mb-4 floating-element">
                <i class="fa-solid fa-circle-info"></i>
            </div>

            <!-- Judul & Deskripsi -->
            <h1 class="display-5 service-title mb-3">Informasi Layanan</h1>
            <p class="service-subtitle mx-auto">
                Panduan lengkap mengenai jam operasional, syarat keanggotaan, dan tata tertib perpustakaan.
            </p>
        </div>
    </section>

    <!-- Konten Utama (Melayang di atas Hero) -->
    <div class="container pb-5" style="margin-top: -65px; position: relative; z-index: 10;">
        <div class="row justify-content-center">
            <div class="col-lg-9 content-box p-4 p-md-5">

                <div class="service-content">
                    <h4 class="fw-bold mb-3" style="color: var(--color-text-main, #0f172a);">Selamat Datang di Perpustakaan
                    </h4>
                    <p style="color: var(--color-text-muted, #64748b);">Kami berkomitmen untuk memberikan pelayanan prima
                        bagi seluruh anggota. Untuk memastikan kenyamanan, kelancaran, dan ketertiban bersama, berikut
                        adalah informasi dasar terkait layanan perpustakaan yang perlu Anda ketahui sebelum berkunjung.</p>

                    <hr class="my-4" style="border-color: rgba(226, 232, 240, 0.8);">

                    <h5 class="fw-bold mb-3" style="color: var(--color-text-main, #0f172a);">
                        <i class="fa-regular fa-clock me-2" style="color: var(--color-primary, #2563eb);"></i> Jam
                        Operasional
                    </h5>
                    <p style="color: var(--color-text-muted, #64748b);">Perpustakaan memberikan layanan secara langsung pada
                        hari kerja dengan jadwal sebagai berikut:</p>
                    <ul class="mb-4">
                        <li><strong style="color: var(--color-text-main, #0f172a);">Senin - Kamis:</strong> 07.30 - 15.30
                            WIB (Istirahat: 12.00 - 13.00 WIB)</li>
                        <li><strong style="color: var(--color-text-main, #0f172a);">Jumat:</strong> 07.30 - 14.30 WIB
                            (Istirahat: 11.30 - 13.00 WIB)</li>
                        <li><strong style="color: var(--color-text-main, #0f172a);">Sabtu, Minggu & Libur Nasional:</strong>
                            Tutup (Layanan Digital tetap dapat diakses 24 jam)</li>
                    </ul>

                    <h5 class="fw-bold mb-3" style="color: var(--color-text-main, #0f172a);">
                        <i class="fa-solid fa-id-card-clip me-2" style="color: var(--color-primary, #2563eb);"></i> Syarat
                        Keanggotaan
                    </h5>
                    <p style="color: var(--color-text-muted, #64748b);">Keanggotaan perpustakaan terbuka untuk warga
                        sekolah/institusi dengan tata cara pendaftaran:</p>
                    <ul class="mb-4">
                        <li>Mengisi formulir pendaftaran anggota di meja sirkulasi atau secara online.</li>
                        <li>Menyerahkan pas foto terbaru ukuran 2x3 sebanyak 1 lembar (untuk kartu fisik).</li>
                        <li>Menunjukkan identitas yang sah (Kartu Pelajar/Kartu Pegawai).</li>
                        <li>Kartu anggota <strong style="color: var(--color-text-main, #0f172a);">wajib dibawa</strong> saat
                            meminjam buku dan tidak dapat dipindahtangankan kepada orang lain.</li>
                    </ul>

                    <h5 class="fw-bold mb-3" style="color: var(--color-text-main, #0f172a);">
                        <i class="fa-solid fa-clipboard-check me-2" style="color: var(--color-primary, #2563eb);"></i> Tata
                        Tertib Umum
                    </h5>
                    <ul>
                        <li>Pemustaka wajib mengisi <strong style="color: var(--color-text-main, #0f172a);">daftar hadir /
                                buku tamu</strong> (digital atau manual) setiap kali memasuki area perpustakaan.</li>
                        <li>Meninggalkan tas, jaket, dan barang bawaan yang tidak diperlukan di loker penitipan yang telah
                            disediakan. Cukup bawa barang berharga, laptop, dan alat tulis.</li>
                        <li>Berpakaian rapi dan sopan sesuai dengan peraturan yang berlaku.</li>
                        <li><strong style="color: var(--color-text-main, #0f172a);">Dilarang makan, minum, dan
                                merokok</strong> di dalam ruangan untuk menjaga kebersihan dan melindungi koleksi dari
                            kerusakan.</li>
                        <li>Turut serta menjaga ketenangan suasana agar tidak mengganggu pemustaka lain yang sedang membaca
                            atau belajar.</li>
                    </ul>
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
                        Mulai Eksplorasi Buku <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>
@endsection

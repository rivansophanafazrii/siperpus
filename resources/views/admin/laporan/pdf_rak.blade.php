<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Data Rak Buku - SMPN 2 Kadugede</title>
    <style>
        @page {
            margin: 1.5cm 2cm;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 9pt;
            color: #2c3e50;
            line-height: 1.4;
        }

        /* Utility */
        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .font-weight-bold {
            font-weight: bold;
        }

        .text-danger {
            color: #e74c3c;
        }

        .text-success {
            color: #27ae60;
        }

        .text-muted {
            color: #7f8c8d;
        }

        .m-0 {
            margin: 0;
        }

        /* Kop Surat Modern (3 Kolom) */
        .kop-surat {
            width: 100%;
            border-bottom: 3px solid #2c3e50;
            padding-bottom: 5px;
            margin-bottom: 2px;
        }

        .kop-surat td {
            padding: 0;
            vertical-align: middle;
        }

        .instansi {
            font-size: 11pt;
            letter-spacing: 1px;
            color: #555;
            text-transform: uppercase;
        }

        .nama-sekolah {
            font-size: 16pt;
            font-weight: 800;
            letter-spacing: 1.5px;
            color: #1a252f;
            margin: 4px 0;
        }

        .kontak-sekolah {
            font-size: 9pt;
            color: #555;
        }

        /* Aksen Garis Bawah Kop */
        .garis-aksen {
            border-bottom: 1px solid #e74c3c;
            margin-bottom: 25px;
        }

        /* Judul Laporan & Filter Info */
        .judul-laporan {
            text-align: center;
            font-size: 12pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }

        .filter-info {
            text-align: center;
            font-size: 9.5pt;
            color: #555;
            margin-bottom: 20px;
            font-style: italic;
        }

        /* Tabel Data Elegan */
        .table-data {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            font-size: 9pt;
        }

        .table-data th,
        .table-data td {
            border: 1px solid #bdc3c7;
            padding: 8px 6px;
            vertical-align: middle;
        }

        .table-data th {
            background-color: #f1f4f6;
            color: #2c3e50;
            font-weight: 700;
            text-align: center;
            text-transform: uppercase;
            font-size: 8pt;
        }

        .table-data tbody tr:nth-child(even) {
            background-color: #fcfcfc;
        }

        /* Area Tanda Tangan */
        .ttd-area {
            width: 100%;
            page-break-inside: avoid;
            margin-top: 30px;
        }
    </style>
</head>

<body>

    @php
        // LOGIKA GAMBAR BASE64 UNTUK DUA LOGO KOP SURAT

        $pathKiri = public_path('img/logo-kiri.png');
        $logoKiriBase64 = '';
        if (file_exists($pathKiri)) {
            $logoKiriBase64 = 'data:image/png;base64,' . base64_encode(file_get_contents($pathKiri));
        }

        $pathKanan = public_path('img/logo-kanan.png');
        $logoKananBase64 = '';
        if (file_exists($pathKanan)) {
            $logoKananBase64 = 'data:image/png;base64,' . base64_encode(file_get_contents($pathKanan));
        }
    @endphp

    <!-- KOP SURAT MODERN -->
    <table class="kop-surat">
        <tr>
            <!-- Kolom Logo Kiri -->
            <td width="15%" class="text-center">
                @if ($logoKiriBase64)
                    <img src="{{ $logoKiriBase64 }}" width="75" alt="Logo Kiri">
                @endif
            </td>

            <!-- Kolom Teks Tengah -->
            <td width="70%" class="text-center">
                <p class="m-0 instansi">Dinas Pendidikan dan Kebudayaan Kab. Kuningan</p>
                <p class="m-0 nama-sekolah">SMP NEGERI 2 KADUGEDE</p>
                <p class="m-0 kontak-sekolah">Jl. Raya Kadugede No. 18, Kuningan, Jawa Barat 45561</p>
                <p class="m-0 kontak-sekolah">Email: info@smpn2kadugede.sch.id | Web: smpn2kadugede.sch.id</p>
            </td>

            <!-- Kolom Logo Kanan -->
            <td width="15%" class="text-center">
                @if ($logoKananBase64)
                    <img src="{{ $logoKananBase64 }}" width="75" alt="Logo Kanan">
                @endif
            </td>
        </tr>
    </table>
    <div class="garis-aksen"></div>

    <!-- JUDUL & INFORMASI PERIODE -->
    <div class="judul-laporan">
        Laporan Data Rak Buku
    </div>
    <div class="filter-info">
        @if ($start && $end)
            Periode Penambahan: {{ \Carbon\Carbon::parse($start)->format('d F Y') }} s/d
            {{ \Carbon\Carbon::parse($end)->format('d F Y') }}
        @else
            Menampilkan Seluruh Data Rak Buku
        @endif
    </div>

    <!-- TABEL DATA -->
    <table class="table-data">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="65%">Nama Rak / Lokasi</th>
                <th width="65%">Lokasi</th>
                <th width="65%">Keterangan</th>
                <th width="30%">Tanggal Ditambahkan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td><span class="font-weight-bold">{{ $item->nama_rak }}</span></td>
                    <td><span class="font-weight-bold">{{ $item->lokasi }}</span></td>
                    <td><span class="font-weight-bold">{{ $item->keterangan }}</span></td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center" style="padding: 30px;">
                        <em>Tidak ada data rak pada periode ini.</em>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- TANDA TANGAN -->
    <table class="ttd-area">
        <tr>
            <td width="65%"></td>
            <td width="35%" class="text-center">
                <p class="m-0">Kadugede, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                <p class="m-0">Kepala Perpustakaan,</p>
                <br><br><br><br>
                <p class="m-0 font-weight-bold" style="text-decoration: underline;">Nama Petugas, S.I.P.</p>
                <p class="m-0">NIP. 19850505 201001 2 002</p>
            </td>
        </tr>
    </table>

</body>

</html>

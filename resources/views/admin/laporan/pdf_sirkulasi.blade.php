<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Sirkulasi & Denda - SMPN 2 Kadugede</title>
    <style>
        @page { margin: 1.5cm 2cm; }
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            font-size: 9pt; 
            color: #2c3e50;
            line-height: 1.4;
        }

        /* Utility */
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .font-weight-bold { font-weight: bold; }
        .text-danger { color: #e74c3c; }
        .text-success { color: #27ae60; }
        .m-0 { margin: 0; }
        .p-2 { padding: 8px; }

        /* Kop Surat Modern (3 Kolom) */
        .kop-surat {
            width: 100%;
            border-bottom: 3px solid #2c3e50;
            padding-bottom: 5px;
            margin-bottom: 2px;
        }
        .kop-surat td { padding: 0; vertical-align: middle; }
        .instansi { font-size: 11pt; letter-spacing: 1px; color: #555; text-transform: uppercase; }
        .nama-sekolah { font-size: 16pt; font-weight: 800; letter-spacing: 1.5px; color: #1a252f; margin: 4px 0; }
        .kontak-sekolah { font-size: 9pt; color: #555; }
        
        /* Aksen Garis Bawah Kop */
        .garis-aksen {
            border-bottom: 1px solid #e74c3c;
            margin-bottom: 25px;
        }

        /* Judul Laporan */
        .judul-laporan {
            text-align: center;
            font-size: 12pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 20px;
        }

        /* Tabel Data Elegan */
        .table-data { 
            width: 100%; 
            border-collapse: collapse; 
            margin-bottom: 30px;
        }
        .table-data th, .table-data td { 
            border: 1px solid #bdc3c7; 
            padding: 7px 5px; 
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
        .table-data tbody tr:nth-child(even) { background-color: #fcfcfc; }
        
        /* Baris Total */
        .row-total td {
            background-color: #ecf0f1;
            font-weight: bold;
            font-size: 9.5pt;
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
        // LOGIKA GAMBAR BASE64 UNTUK DOMPDF
        
        // 1. Logo Kiri (Misal: Tut Wuri Handayani / Pemkab)
        $pathKiri = public_path('img/logo-kiri.png');
        $logoKiriBase64 = '';
        if(file_exists($pathKiri)){
            $logoKiriBase64 = 'data:image/png;base64,' . base64_encode(file_get_contents($pathKiri));
        }

        // 2. Logo Kanan (Misal: Logo Sekolah)
        $pathKanan = public_path('img/logo-kanan.png');
        $logoKananBase64 = '';
        if(file_exists($pathKanan)){
            $logoKananBase64 = 'data:image/png;base64,' . base64_encode(file_get_contents($pathKanan));
        }
    @endphp

    <!-- KOP SURAT MODERN DENGAN DUA LOGO -->
    <table class="kop-surat">
        <tr>
            <!-- Kolom Logo Kiri -->
            <td width="15%" class="text-center">
                @if($logoKiriBase64)
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
                @if($logoKananBase64)
                    <img src="{{ $logoKananBase64 }}" width="75" alt="Logo Kanan">
                @endif
            </td>
        </tr>
    </table>
    <div class="garis-aksen"></div>

    <div class="judul-laporan">
        Laporan Sirkulasi & Rekap Denda Perpustakaan
    </div>

    <!-- TABEL DATA -->
    <table class="table-data">
        <thead>
            <tr>
                <th width="4%">No</th>
                <th width="15%">Nama Siswa</th>
                <th width="23%">Judul Buku</th>
                <th width="11%">Tgl Pinjam</th>
                <th width="11%">Tenggat</th>
                <th width="11%">Dikembalikan</th>
                <th width="9%">Terlambat</th>
                <th width="9%">Denda</th>
                <th width="7%">Status</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalKeseluruhanDenda = 0;
            @endphp

            @forelse($data as $index => $item)
                @php
                    $tenggatWaktu = \Carbon\Carbon::parse($item->tenggat_waktu)->startOfDay();
                    $tglDikembalikan = null;
                    $hariTerlambat = 0;

                    if (!empty($item->tanggal_dikembalikan)) {
                        $tglDikembalikan = \Carbon\Carbon::parse($item->tanggal_dikembalikan)->startOfDay();
                        if ($tglDikembalikan->gt($tenggatWaktu)) {
                            $hariTerlambat = $tenggatWaktu->diffInDays($tglDikembalikan);
                        }
                    } else {
                        $hariIni = \Carbon\Carbon::now()->startOfDay();
                        if ($hariIni->gt($tenggatWaktu)) {
                            $hariTerlambat = $tenggatWaktu->diffInDays($hariIni);
                        }
                    }

                    $denda = $item->denda ?? 0; 
                    $totalKeseluruhanDenda += $denda;
                @endphp
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $item->user->name ?? '-' }}</td>
                    <td>{{ $item->buku->judul ?? '-' }}</td>
                    
                    <td class="text-center">{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d-m-Y') }}</td>
                    <td class="text-center">{{ $tenggatWaktu->format('d-m-Y') }}</td>
                    <td class="text-center">
                        {{ $tglDikembalikan ? $tglDikembalikan->format('d-m-Y') : '-' }}
                    </td>
                    
                    <td class="text-center font-weight-bold {{ $hariTerlambat > 0 ? 'text-danger' : '' }}">
                        {{ $hariTerlambat > 0 ? $hariTerlambat . ' Hari' : '-' }}
                    </td>
                    <td class="text-right">
                        {{ $denda > 0 ? 'Rp ' . number_format($denda, 0, ',', '.') : '-' }}
                    </td>
                    <td class="text-center font-weight-bold">
                        @if(strtolower($item->status) == 'dipinjam')
                            <span style="color: #2980b9;">Aktif</span>
                        @elseif(strtolower($item->status) == 'dikembalikan')
                            <span class="text-success">Selesai</span>
                        @else
                            {{ ucfirst($item->status) }}
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center" style="padding: 30px;">
                        <em>Tidak ada riwayat sirkulasi untuk rentang waktu ini.</em>
                    </td>
                </tr>
            @endforelse
        </tbody>
        
        <!-- BARIS TOTAL DENDA -->
        @if(count($data) > 0)
        <tfoot>
            <tr class="row-total">
                <td colspan="7" class="text-right p-2">TOTAL PENDAPATAN DENDA :</td>
                <td class="text-right p-2 text-danger">Rp {{ number_format($totalKeseluruhanDenda, 0, ',', '.') }}</td>
                <td></td>
            </tr>
        </tfoot>
        @endif
    </table>

    <!-- TANDA TANGAN -->
    <table class="ttd-area">
        <tr>
            <td width="65%"></td>
            <td width="35%" class="text-center">
                <p class="m-0">Kadugede, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                <p class="m-0">Kepala Perpustakaan,</p>
                <br><br><br><br>
                <p class="m-0 font-weight-bold" style="text-decoration: underline;">Rivan Sophana Fazri</p>
                <p class="m-0">NIP. 19850505 201001 2 002</p>
            </td>
        </tr>
    </table>

</body>
</html>
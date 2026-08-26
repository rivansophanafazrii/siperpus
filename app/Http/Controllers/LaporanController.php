<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\User;
use App\Models\Buku;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use App\Exports\LaporanSirkulasiExport;
use App\Exports\LaporanAnggotaExport;
use App\Exports\BukuAnggotaExport;

class LaporanController extends Controller
{
    public function index()
    {
        return view('admin.laporan.index');
    }

    public function generate(Request $request)
    {
        $jenis = $request->jenis_laporan;
        $subJenis = $request->sub_jenis;
        $format = $request->format;
        $rentangWaktu = $request->rentang_waktu;

        $startDate = null;
        $endDate = null;

        // 1. Logika Pemrosesan Rentang Waktu
        if ($rentangWaktu == 'mingguan') {
            $startDate = Carbon::now()->startOfWeek()->format('Y-m-d');
            $endDate = Carbon::now()->endOfWeek()->format('Y-m-d');
        } elseif ($rentangWaktu == 'bulanan') {
            $startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
            $endDate = Carbon::now()->endOfMonth()->format('Y-m-d');
        } elseif ($rentangWaktu == 'tahunan') {
            $startDate = Carbon::now()->startOfYear()->format('Y-m-d');
            $endDate = Carbon::now()->endOfYear()->format('Y-m-d');
        } elseif ($rentangWaktu == 'custom') {
            $startDate = $request->start_date;
            $endDate = $request->end_date;
        }

        // 2. Logika untuk Master Data
        if ($jenis == 'master_data') {

            // --- SUB: DATA ANGGOTA ---
            if ($subJenis == 'anggota') {
                $query = User::query();
                if ($startDate && $endDate) {
                    $query->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
                }
                $data = $query->get();

                if ($format == 'pdf') {
                    $pdf = Pdf::loadView('admin.laporan.pdf_anggota', [
                        'data' => $data,
                        'start' => $startDate,
                        'end' => $endDate
                    ]);
                    return $pdf->stream('Laporan_Data_Anggota.pdf');
                } elseif ($format == 'excel') {
                    return Excel::download(new LaporanAnggotaExport($startDate, $endDate), 'Laporan_Data_Anggota.xlsx');
                }
            }
            // --- SUB: DATA BUKU ---
            elseif ($subJenis == 'buku') {
                // Asumsi model Buku berelasi dengan Kategori dan Rak
                $query = Buku::with(['kategori', 'kategori']);

                if ($startDate && $endDate) {
                    // Filter berdasarkan tanggal buku ditambahkan ke sistem
                    $query->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
                }
                $data = $query->get();

                if ($format == 'pdf') {
                    $pdf = Pdf::loadView('admin.laporan.pdf_buku', [
                        'data' => $data,
                        'start' => $startDate,
                        'end' => $endDate
                    ])->setPaper('a4', 'landscape'); // Ubah orientasi kertas jadi Landscape

                    return $pdf->stream('Laporan_Data_Buku.pdf');
                } elseif ($format == 'excel') {
                    return Excel::download(new \App\Exports\LaporanBukuExport($startDate, $endDate), 'Laporan_Data_Buku.xlsx');
                }
            }
            // --- SUB: DATA KATEGORI BUKU ---
            elseif ($subJenis == 'kategori') {
                // Asumsi nama modelnya adalah Kategori
                $query = \App\Models\Kategori::query();

                if ($startDate && $endDate) {
                    $query->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
                }
                $data = $query->get();

                if ($format == 'pdf') {
                    $pdf = Pdf::loadView('admin.laporan.pdf_kategori', [
                        'data' => $data,
                        'start' => $startDate,
                        'end' => $endDate
                    ]);

                    return $pdf->stream('Laporan_Kategori_Buku.pdf');
                } elseif ($format == 'excel') {
                    return Excel::download(new \App\Exports\LaporanKategoriExport($startDate, $endDate), 'Laporan_Kategori_Buku.xlsx');
                }
            }

            // --- SUB: DATA RAK BUKU ---
            elseif ($subJenis == 'rak') {
                // Asumsi nama modelnya adalah Rak
                $query = \App\Models\Rak::query();

                if ($startDate && $endDate) {
                    $query->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
                }
                $data = $query->get();

                if ($format == 'pdf') {
                    $pdf = Pdf::loadView('admin.laporan.pdf_rak', [
                        'data' => $data,
                        'start' => $startDate,
                        'end' => $endDate
                    ]);

                    return $pdf->stream('Laporan_Rak_Buku.pdf');
                } elseif ($format == 'excel') {
                    return Excel::download(new \App\Exports\LaporanRakExport($startDate, $endDate), 'Laporan_Rak_Buku.xlsx');
                }
            }
        }

        // 3. Logika untuk Sirkulasi Buku
        if ($jenis == 'sirkulasi') {
            $query = Peminjaman::with(['user', 'buku']);

            if ($startDate && $endDate) {
                $query->whereBetween('tanggal_pinjam', [$startDate, $endDate]);
            }
            $data = $query->get();

            if ($format == 'pdf') {
                $pdf = Pdf::loadView('admin.laporan.pdf_sirkulasi', [
                    'data' => $data,
                    'start' => $startDate,
                    'end' => $endDate
                ]);
                return $pdf->stream('Laporan_Sirkulasi_Buku.pdf');
            } elseif ($format == 'excel') {
                return Excel::download(new LaporanSirkulasiExport($startDate, $endDate), 'Laporan_Sirkulasi_Buku.xlsx');
            }
        }

        // 4. Logika untuk Data Berita
        if ($jenis == 'berita') {
            // Asumsi nama modelnya adalah Berita
            $query = \App\Models\Berita::query();

            if ($startDate && $endDate) {
                // Menggunakan created_at atau bisa disesuaikan jika Anda punya kolom tanggal_publikasi
                $query->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
            }
            $data = $query->get();

            if ($format == 'pdf') {
                $pdf = Pdf::loadView('admin.laporan.pdf_berita', [
                    'data' => $data,
                    'start' => $startDate,
                    'end' => $endDate
                ]);

                return $pdf->stream('Laporan_Data_Berita.pdf');
            } elseif ($format == 'excel') {
                return Excel::download(new \App\Exports\LaporanBeritaExport($startDate, $endDate), 'Laporan_Data_Berita.xlsx');
            }
        }

        // 5. Logika untuk Data Buku Tamu
        if ($jenis == 'buku_tamu') {
            // Asumsi nama modelnya adalah BukuTamu
            $query = \App\Models\BukuTamu::query();

            if ($startDate && $endDate) {
                // Filter berdasarkan waktu kunjungan / waktu data diinput
                $query->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
            }
            $data = $query->get();

            if ($format == 'pdf') {
                $pdf = Pdf::loadView('admin.laporan.pdf_buku_tamu', [
                    'data' => $data,
                    'start' => $startDate,
                    'end' => $endDate
                ]);

                return $pdf->stream('Laporan_Buku_Tamu.pdf');
            } elseif ($format == 'excel') {
                return Excel::download(new \App\Exports\LaporanBukuTamuExport($startDate, $endDate), 'Laporan_Buku_Tamu.xlsx');
            }
        }

        // 6. Logika untuk Data Survei & Feedback
        if ($jenis == 'survei') {

            // --- SUB: SURVEI KEBUTUHAN ---
            // Sesuaikan 'kebutuhan' dengan value di tag <option> file index.blade.php Anda
            if ($subJenis == 'kebutuhan' || $subJenis == 'survei_kebutuhan') {
                $query = \App\Models\SurveiKebutuhan::query();

                if ($startDate && $endDate) {
                    $query->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
                }
                $data = $query->get();

                if ($format == 'pdf') {
                    $pdf = Pdf::loadView('admin.laporan.pdf_survei_kebutuhan', [
                        'data' => $data,
                        'start' => $startDate,
                        'end' => $endDate
                    ]);
                    return $pdf->stream('Laporan_Survei_Kebutuhan.pdf');
                } elseif ($format == 'excel') {
                    return Excel::download(new \App\Exports\LaporanSurveiKebutuhanExport($startDate, $endDate), 'Laporan_Survei_Kebutuhan.xlsx');
                }
            }
            // --- SUB: SURVEI KEPUASAN ---
            // Sesuaikan 'kepuasan' dengan value di tag <option> file index.blade.php Anda
            elseif ($subJenis == 'kepuasan' || $subJenis == 'survei_kepuasan') {
                $query = \App\Models\SurveiKepuasan::query();

                if ($startDate && $endDate) {
                    $query->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
                }
                $data = $query->get();

                if ($format == 'pdf') {
                    $pdf = Pdf::loadView('admin.laporan.pdf_survei_kepuasan', [
                        'data' => $data,
                        'start' => $startDate,
                        'end' => $endDate
                    ]);
                    return $pdf->stream('Laporan_Survei_Kepuasan.pdf');
                } elseif ($format == 'excel') {
                    return Excel::download(new \App\Exports\LaporanSurveiKepuasanExport($startDate, $endDate), 'Laporan_Survei_Kepuasan.xlsx');
                }
            }
        }

        return back()->with('error', 'Jenis laporan atau format tidak valid!');
    }
}

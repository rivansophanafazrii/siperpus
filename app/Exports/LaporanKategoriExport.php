<?php

namespace App\Exports;

use App\Models\Kategori;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class LaporanKategoriExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithEvents, WithCustomStartCell
{
    protected $startDate;
    protected $endDate;
    private $rowNumber = 0;

    public function __construct($startDate = null, $endDate = null)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection(): \Illuminate\Support\Collection
    {
        $query = Kategori::query();

        if ($this->startDate && $this->endDate) {
            $query->whereBetween('created_at', [$this->startDate . ' 00:00:00', $this->endDate . ' 23:59:59']);
        }

        return $query->get();
    }

    // Memulai tabel pada baris ke-8 (menyisakan ruang untuk Kop Surat)
    public function startCell(): string
    {
        return 'A8';
    }

    public function headings(): array
    {
        return [
            'NO',
            'NAMA KATEGORI',
            'TANGGAL DITAMBAHKAN'
        ];
    }

    public function map($kategori): array
    {
        $this->rowNumber++;

        return [
            $this->rowNumber,
            $kategori->nama_kategori,
            Carbon::parse($kategori->created_at)->format('d-m-Y'), // Diformat menjadi d-m-Y agar seragam
        ];
    }

    // Menerapkan styling (Kop Surat, Judul, Bold Header, dan Tanda Tangan)
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $lastCol = 'C'; // Kolom terakhir adalah C karena hanya ada 3 kolom

                // ==========================================
                // 1. MEMBUAT KOP SURAT (Baris 1-4)
                // ==========================================
                $sheet->mergeCells('A1:' . $lastCol . '1');
                $sheet->setCellValue('A1', 'DINAS PENDIDIKAN DAN KEBUDAYAAN KAB. KUNINGAN');

                $sheet->mergeCells('A2:' . $lastCol . '2');
                $sheet->setCellValue('A2', 'SMP NEGERI 2 KADUGEDE');
                $sheet->getStyle('A2')->getFont()->setBold(true)->setSize(14);

                $sheet->mergeCells('A3:' . $lastCol . '3');
                $sheet->setCellValue('A3', 'Jl. Raya Kadugede No. XX, Kuningan, Jawa Barat 45561');

                $sheet->mergeCells('A4:' . $lastCol . '4');
                $sheet->setCellValue('A4', 'Email: info@smpn2kadugede.sch.id | Web: smpn2kadugede.sch.id');

                $sheet->getStyle('A1:A4')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('A4:' . $lastCol . '4')->getBorders()->getBottom()->setBorderStyle(Border::BORDER_DOUBLE);

                // ==========================================
                // 2. JUDUL LAPORAN & FILTER PERIODE (Baris 6-7)
                // ==========================================
                $sheet->mergeCells('A6:' . $lastCol . '6');
                $sheet->setCellValue('A6', 'LAPORAN DATA KATEGORI BUKU');
                $sheet->getStyle('A6')->getFont()->setBold(true);

                $periode = 'Menampilkan Seluruh Data Kategori';
                if ($this->startDate && $this->endDate) {
                    $periode = 'Periode: ' . Carbon::parse($this->startDate)->format('d F Y') . ' s/d ' . Carbon::parse($this->endDate)->format('d F Y');
                }
                $sheet->mergeCells('A7:' . $lastCol . '7');
                $sheet->setCellValue('A7', $periode);
                $sheet->getStyle('A7')->getFont()->setItalic(true);

                $sheet->getStyle('A6:A7')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                // ==========================================
                // 3. STYLING HEADER TABEL (Baris 8)
                // ==========================================
                $sheet->getStyle('A8:' . $lastCol . '8')->getFont()->setBold(true);
                $sheet->getStyle('A8:' . $lastCol . '8')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('A8:' . $lastCol . '8')->getFill()
                    ->setFillType(Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('FFF2F2F2');

                // ==========================================
                // 4. MEMBUAT BLOK TANDA TANGAN DI BAWAH TABEL
                // ==========================================
                $lastRow = $sheet->getHighestRow();
                $ttdRow = $lastRow + 3;

                // Tanda tangan ditempatkan di Kolom C 
                $sheet->setCellValue('C' . $ttdRow, 'Kadugede, ' . Carbon::now()->translatedFormat('d F Y'));
                $sheet->setCellValue('C' . ($ttdRow + 1), 'Kepala Perpustakaan,');

                $sheet->setCellValue('C' . ($ttdRow + 5), 'Nama Petugas, S.I.P.');
                $sheet->getStyle('C' . ($ttdRow + 5))->getFont()->setBold(true)->setUnderline(true);

                $sheet->setCellValue('C' . ($ttdRow + 6), 'NIP. 19850505 201001 2 002');
            },
        ];
    }
}

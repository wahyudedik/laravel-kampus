<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AbsensiExport implements FromCollection, WithHeadings, WithMapping, WithTitle, WithStyles, ShouldAutoSize
{
    protected $absensi;

    public function __construct($absensi)
    {
        $this->absensi = $absensi;
    }

    public function collection()
    {
        return $this->absensi->mahasiswas;
    }

    public function headings(): array
    {
        return [
            'No.',
            'NIM',
            'Nama Mahasiswa',
            'Status',
            'Keterangan'
        ];
    }

    public function map($mahasiswa): array
    {
        static $i = 0;
        $i++;

        $status = '';
        switch ($mahasiswa->status) {
            case 'hadir':
                $status = 'Hadir';
                break;
            case 'izin':
                $status = 'Izin';
                break;
            case 'sakit':
                $status = 'Sakit';
                break;
            case 'alpa':
                $status = 'Alpa';
                break;
        }

        return [
            $i,
            $mahasiswa->nim,
            $mahasiswa->nama_mahasiswa,
            $status,
            $mahasiswa->keterangan ?? '-'
        ];
    }

    public function title(): string
    {
        return 'Daftar Hadir';
    }

    public function styles(Worksheet $sheet)
    {
        // Add title and info at the top
        $sheet->mergeCells('A1:E1');
        $sheet->setCellValue('A1', 'DAFTAR HADIR PERKULIAHAN');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');

        // Add course info
        $sheet->setCellValue('A3', 'Mata Kuliah');
        $sheet->setCellValue('B3', ': ' . $this->absensi->mata_kuliah);
        $sheet->setCellValue('D3', 'Kode Kelas');
        $sheet->setCellValue('E3', ': ' . $this->absensi->kode_kelas);

        $sheet->setCellValue('A4', 'Tanggal');
        $sheet->setCellValue('B4', ': ' . $this->absensi->tanggal->format('d F Y'));
        $sheet->setCellValue('D4', 'Jam');
        $sheet->setCellValue('E4', ': ' . substr($this->absensi->jam_mulai, 0, 5) . ' - ' . substr($this->absensi->jam_selesai, 0, 5));

        $sheet->setCellValue('A5', 'Ruangan');
        $sheet->setCellValue('B5', ': ' . $this->absensi->ruangan);
        $sheet->setCellValue('D5', 'Dosen');
        $sheet->setCellValue('E5', ': ' . $this->absensi->dosen_pengajar);

        $sheet->setCellValue('A6', 'Pertemuan');
        $sheet->setCellValue('B6', ': ' . $this->absensi->pertemuan);

        // Style the header row
        $sheet->getStyle('A8:E8')->getFont()->setBold(true);
        $sheet->getStyle('A8:E8')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFCCCCCC');
        
        // Set borders for the table
        $lastRow = 8 + $this->absensi->mahasiswas->count();
        $sheet->getStyle('A8:E' . $lastRow)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        
        // Add summary at the bottom
        $summaryRow = $lastRow + 2;
        $sheet->setCellValue('A' . $summaryRow, 'Rekapitulasi Kehadiran:');
        $sheet->getStyle('A' . $summaryRow)->getFont()->setBold(true);
        
        $sheet->setCellValue('A' . ($summaryRow + 1), 'Jumlah Mahasiswa');
        $sheet->setCellValue('B' . ($summaryRow + 1), ': ' . $this->absensi->mahasiswas->count() . ' orang');
        
        $sheet->setCellValue('A' . ($summaryRow + 2), 'Hadir');
        $sheet->setCellValue('B' . ($summaryRow + 2), ': ' . $this->absensi->mahasiswas->where('status', 'hadir')->count() . ' orang');
        
        $sheet->setCellValue('A' . ($summaryRow + 3), 'Izin');
        $sheet->setCellValue('B' . ($summaryRow + 3), ': ' . $this->absensi->mahasiswas->where('status', 'izin')->count() . ' orang');
        
        $sheet->setCellValue('A' . ($summaryRow + 4), 'Sakit');
        $sheet->setCellValue('B' . ($summaryRow + 4), ': ' . $this->absensi->mahasiswas->where('status', 'sakit')->count() . ' orang');
        
        $sheet->setCellValue('A' . ($summaryRow + 5), 'Alpa');
        $sheet->setCellValue('B' . ($summaryRow + 5), ': ' . $this->absensi->mahasiswas->where('status', 'alpa')->count() . ' orang');

        return [
            // Style the header row
            8 => ['font' => ['bold' => true]],
        ];
    }
}

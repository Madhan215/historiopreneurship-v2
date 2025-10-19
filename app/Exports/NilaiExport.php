<?php

namespace App\Exports;

use App\Models\Nilai;
use App\Models\Kelas;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class NilaiExport implements FromCollection, WithHeadings, WithEvents
{
    protected $kodeKelas;

    public function __construct($kodeKelas)
    {
        $this->kodeKelas = $kodeKelas;
    }

    public function collection()
    {
        return Nilai::where('kode_kelas', $this->kodeKelas)
            ->select('email', 'aspek', 'nilai_akhir', 'data_jawaban_penilai', 'tipe', 'waktu_selesai')
            ->get();
    }

    public function headings(): array
    {
        return ['Email', 'Aspek', 'Nilai Akhir', 'Jawaban Penilai', 'Tipe', 'Waktu Selesai'];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $kelas = Kelas::where('kode_kelas', $this->kodeKelas)->first();
                $namaKelas = $kelas ? $kelas->nama_kelas : '-';

                $tanggal = now()->format('d M Y, H:i');

                $event->sheet->insertNewRowBefore(1, 3);
                $event->sheet->setCellValue('A1', 'Kode Kelas: ' . $this->kodeKelas . ' - ' . $namaKelas);
                $event->sheet->setCellValue('A2', 'Diekspor pada: ' . $tanggal);

                $event->sheet->getStyle('A1')->getFont()->setBold(true)->setSize(13);
                $event->sheet->getStyle('A2')->getFont()->setItalic(true)->setSize(10);
            },
        ];
    }
}

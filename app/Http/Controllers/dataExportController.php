<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Nilai;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Storage;

class dataExportController extends Controller
{
    public function exportEvaluasi()
    {
        // Ambil data mahasiswa dan nilai evaluasi dari database
        $mahasiswa = User::join('nilai', 'users.email', '=', 'nilai.email')
            ->where('nilai.aspek', 'evaluasi')
            ->select('users.nama_lengkap', 'users.kelas', 'nilai.nilai_akhir')
            ->get();

        // Buat instance Spreadsheet baru
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Tambahkan judul kolom
        $sheet->setCellValue('A1', 'Nomor');
        $sheet->setCellValue('B1', 'Nama');
        $sheet->setCellValue('C1', 'Kelas');
        $sheet->setCellValue('D1', 'Nilai Evaluasi');

        // Tambahkan data ke sheet
        $row = 2;
        $no = 1;
        foreach ($mahasiswa as $data) {
            $sheet->setCellValue('A' . $row, $no);
            $sheet->setCellValue('B' . $row, $data->nama_lengkap);
            $sheet->setCellValue('C' . $row, $data->kelas);
            $sheet->setCellValue('D' . $row, $data->nilai_akhir);
            $row++;
            $no++;
        }

        // Membuat Writer untuk menyimpan file Excel (Xlsx)
        $writer = new Xlsx($spreadsheet);
        $filePath = 'exports/data_evaluasi.xlsx';

        // Simpan file ke storage sementara
        $writer->save(storage_path('app/' . $filePath));

        // Kirim file sebagai respon download dan hapus setelah dikirim
        return response()->download(storage_path('app/' . $filePath))->deleteFileAfterSend(true);
    }

    public function exportKelas()
    {
        // Mengambil data jumlah mahasiswa, jumlah laki-laki, dan jumlah perempuan untuk kelas a1 dan a2
        $kelasA1 = \DB::table('users')->where('kelas', 'a1')->get();
        $kelasA2 = \DB::table('users')->where('kelas', 'a2')->get();

        $jumlahLakiA1 = $kelasA1->where('jenis_kelamin', 'L')->count();
        $jumlahPerempuanA1 = $kelasA1->where('jenis_kelamin', 'P')->count();
        $totalKelasA1 = $kelasA1->count();

        $jumlahLakiA2 = $kelasA2->where('jenis_kelamin', 'L')->count();
        $jumlahPerempuanA2 = $kelasA2->where('jenis_kelamin', 'P')->count();
        $totalKelasA2 = $kelasA2->count();

        // Buat instance Spreadsheet baru
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Tambahkan judul kolom
        $sheet->setCellValue('A1', 'Nomor');
        $sheet->setCellValue('B1', 'Kelas');
        $sheet->setCellValue('C1', 'Jumlah Mahasiswa');
        $sheet->setCellValue('D1', 'Jumlah Laki-Laki');
        $sheet->setCellValue('E1', 'Jumlah Perempuan');

        // Tambahkan data ke sheet
        $sheet->setCellValue('A2', '1');
        $sheet->setCellValue('B2', 'A1');
        $sheet->setCellValue('C2', $totalKelasA1);
        $sheet->setCellValue('D2', $jumlahLakiA1);
        $sheet->setCellValue('E2', $jumlahPerempuanA1);

        $sheet->setCellValue('A3', '2');
        $sheet->setCellValue('B3', 'A2');
        $sheet->setCellValue('C3', $totalKelasA2);
        $sheet->setCellValue('D3', $jumlahLakiA2);
        $sheet->setCellValue('E3', $jumlahPerempuanA2);

        // Membuat Writer untuk menyimpan file Excel (Xlsx)
        $writer = new Xlsx($spreadsheet);
        $filePath = 'exports/data_kelas.xlsx';

        // Simpan file ke storage sementara
        $writer->save(storage_path('app/' . $filePath));

        // Kirim file sebagai respon download dan hapus setelah dikirim
        return response()->download(storage_path('app/' . $filePath))->deleteFileAfterSend(true);
    }

    public function exportNilai()
    {
        // Mengambil data nilai dari tabel
        $mahasiswa = \DB::table('users')
            ->join('nilai', 'users.email', '=', 'nilai.email')
            ->where('users.peran', 'siswa')
            ->select(
                'users.nama_lengkap',
                'users.kelas',
                \DB::raw("
            MAX(CASE WHEN nilai.aspek = 'pre_test_kesejarahan' THEN nilai.nilai_akhir END) AS pre_test_kesejarahan,
            MAX(CASE WHEN nilai.aspek = 'post_test_kesejarahan' THEN nilai.nilai_akhir END) AS post_test_kesejarahan,
            MAX(CASE WHEN nilai.aspek = 'poin_DND_kesejarahan' THEN nilai.nilai_akhir END) AS poin_DND_kesejarahan,
            MAX(CASE WHEN nilai.aspek = 'pre_test_KWU' THEN nilai.nilai_akhir END) AS pre_test_KWU,
            MAX(CASE WHEN nilai.aspek = 'post_test_KWU' THEN nilai.nilai_akhir END) AS post_test_KWU,
            MAX(CASE WHEN nilai.aspek = 'poin_DND_KWU' THEN nilai.nilai_akhir END) AS poin_DND_KWU
        ")
            )
            ->groupBy('users.nama_lengkap', 'users.kelas')
            ->get();

        // Membuat Spreadsheet baru
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Menambahkan header
        $sheet->setCellValue('A1', 'Nomor');
        $sheet->setCellValue('B1', 'Nama Lengkap');
        $sheet->setCellValue('C1', 'Kelas');
        $sheet->setCellValue('D1', 'Pre Test Kesejarahan');
        $sheet->setCellValue('E1', 'Post Test Kesejarahan');
        $sheet->setCellValue('F1', 'Poin DND Kesejarahan');
        $sheet->setCellValue('G1', 'Pre Test KWU');
        $sheet->setCellValue('H1', 'Post Test KWU');
        $sheet->setCellValue('I1', 'Poin DND KWU');

        // Menambahkan data ke sheet
        $row = 2;
        foreach ($mahasiswa as $key => $data) {
            $sheet->setCellValue('A' . $row, $key + 1);
            $sheet->setCellValue('B' . $row, $data->nama_lengkap);
            $sheet->setCellValue('C' . $row, $data->kelas);
            $sheet->setCellValue('D' . $row, $data->pre_test_kesejarahan);
            $sheet->setCellValue('E' . $row, $data->post_test_kesejarahan);
            $sheet->setCellValue('F' . $row, $data->poin_DND_kesejarahan);
            $sheet->setCellValue('G' . $row, $data->pre_test_KWU);
            $sheet->setCellValue('H' . $row, $data->post_test_KWU);
            $sheet->setCellValue('I' . $row, $data->poin_DND_KWU);
            $row++;
        }

        // Membuat Writer untuk menyimpan file Excel
        $writer = new Xlsx($spreadsheet);
        $filePath = 'exports/data_nilai.xlsx';

        // Simpan file ke storage sementara
        $writer->save(storage_path('app/' . $filePath));

        // Kirim file sebagai respon download dan hapus setelah dikirim
        return response()->download(storage_path('app/' . $filePath))->deleteFileAfterSend(true);
    }
}
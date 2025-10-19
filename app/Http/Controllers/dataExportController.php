<?php



namespace App\Http\Controllers;

use App\Models\evaluasiDinamis;
use App\Models\Kelas;
use App\Models\uploadDinamis;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Nilai;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

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


    public function exportMahasiswa()
    {
        $guru = auth()->user();
        $tokensGuru = $guru->token_kelas;

        $kodeKelasAktifGuru = collect($tokensGuru)
            ->where('status', 'aktif')
            ->pluck('kode')
            ->toArray();

        if (empty($kodeKelasAktifGuru)) {
            return redirect()->back()->with('warning', 'Tidak ada kelas aktif ditemukan untuk guru ini.');
        }

        // Ambil nama kelas dari tabel kelas
        $kelasData = Kelas::whereIn('kode_kelas', $kodeKelasAktifGuru)
            ->pluck('nama_kelas')
            ->toArray();
        $namaKelas = implode('_', $kelasData) ?: 'TanpaNamaKelas';

        // Ambil semua mahasiswa dalam kelas aktif
        $Mahasiswas = User::where('peran', 'siswa')
            ->whereNotNull('token_kelas')
            ->get()
            ->filter(function ($siswa) use ($kodeKelasAktifGuru) {
                $tokensSiswa = $siswa->token_kelas;
                if (!is_array($tokensSiswa))
                    return false;

                foreach ($tokensSiswa as $token) {
                    if (in_array($token['kode'], $kodeKelasAktifGuru)) {
                        return true;
                    }
                }
                return false;
            })
            ->sortBy(function ($item) {
                return strtolower($item->nama_lengkap ?? '');
            }); // urutkan A-Z berdasarkan nama_lengkap

        // === Buat Spreadsheet ===
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header kolom
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama');
        $sheet->setCellValue('C1', 'Email');

        // Isi data mahasiswa
        $row = 2;
        $no = 1;
        foreach ($Mahasiswas as $mhs) {
            $sheet->setCellValue("A{$row}", $no++);
            $sheet->setCellValue("B{$row}", $mhs->nama_lengkap ?? '-');
            $sheet->setCellValue("C{$row}", $mhs->email ?? '-');
            $row++;
        }

        // Autofit kolom agar rapi
        foreach (range('A', 'C') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // === Outputkan ke browser ===
        $writer = new Xlsx($spreadsheet);
        $fileName = "data_mahasiswa_{$namaKelas}.xlsx";

        $temp_file = tempnam(sys_get_temp_dir(), 'excel_');
        $writer->save($temp_file);

        return response()->download($temp_file, $fileName)->deleteFileAfterSend(true);
    }

    public function exportNilaiExcel(Request $request)
    {
        $guru = auth()->user();

        // Ambil filter tipe dari request (bisa kosong, evaluasi, atau upload)
        $filterTipe = $request->input('tipe');

        // Ambil token kelas milik guru
        $tokensGuru = $guru->token_kelas;

        // Ambil semua kode kelas aktif
        $kodeKelasAktifGuru = collect($tokensGuru)
            ->where('status', 'aktif')
            ->pluck('kode')
            ->toArray();

        // Jika tidak ada kelas aktif
        if (empty($kodeKelasAktifGuru)) {
            return back()->with('warning', 'Tidak ada kelas aktif ditemukan untuk guru ini.');
        }

        // Ambil semua siswa yang tergabung dalam kelas aktif guru
        $Mahasiswas = User::where('peran', 'siswa')
            ->whereNotNull('token_kelas')
            ->get()
            ->filter(function ($siswa) use ($kodeKelasAktifGuru) {
                $tokensSiswa = $siswa->token_kelas;
                if (!is_array($tokensSiswa))
                    return false;
                foreach ($tokensSiswa as $token) {
                    if (in_array($token['kode'], $kodeKelasAktifGuru))
                        return true;
                }
                return false;
            })
            ->pluck('email')
            ->toArray();

        // Ambil data evaluasiDinamis dan uploadDinamis yang aktif
        $evaluasiAktif = evaluasiDinamis::where('status', 'on')->get();
        $uploadAktif = uploadDinamis::where('status', 'on')->get();

        // Gabungkan aspek aktif
        $aspekAktif = collect()
            ->merge($evaluasiAktif->pluck('nama_evaluasi'))
            ->merge($uploadAktif->pluck('nama_upload'))
            ->toArray();

        // Ambil nilai mahasiswa hanya dari siswa dan aspek yang aktif
        $query = DB::table('nilai')
            ->join('users', 'users.email', '=', 'nilai.email')
            ->whereIn('nilai.aspek', $aspekAktif)
            ->whereIn('nilai.email', $Mahasiswas)
            ->select('users.nama_lengkap', 'nilai.email', 'nilai.aspek', 'nilai.tipe', 'nilai.nilai_akhir')
            ->orderBy('users.nama_lengkap', 'asc');

        // Jika ada filter tipe, tambahkan
        if (!empty($filterTipe)) {
            $query->where('nilai.tipe', $filterTipe);
        }

        $dataNilai = $query->get();

        // === Membuat spreadsheet ===
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Data Nilai');

        // Header
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama Lengkap');
        $sheet->setCellValue('C1', 'Email');
        $sheet->setCellValue('D1', 'Aspek');
        $sheet->setCellValue('E1', 'Nilai Akhir');
        $sheet->setCellValue('F1', 'Tipe');

        // Gaya header
        $headerStyle = [
            'font' => ['bold' => true],
            'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
            'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'E0E0E0'],
            ],
        ];
        $sheet->getStyle('A1:F1')->applyFromArray($headerStyle);

        // Isi data
        $row = 2;
        foreach ($dataNilai as $index => $item) {
            $sheet->setCellValue('A' . $row, $index + 1);
            $sheet->setCellValue('B' . $row, $item->nama_lengkap ?? '-');
            $sheet->setCellValue('C' . $row, $item->email ?? '-');
            $sheet->setCellValue('D' . $row, $item->aspek ?? '-');
            $sheet->setCellValue('E' . $row, $item->nilai_akhir ?? '-');
            $sheet->setCellValue('F' . $row, $item->tipe ?? '-');
            $row++;
        }

        // Auto width kolom
        foreach (range('A', 'F') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Border semua data
        $sheet->getStyle('A1:F' . ($row - 1))->applyFromArray([
            'borders' => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]],
        ]);

        // Output file
        $writer = new Xlsx($spreadsheet);
        $filename = 'Data_Nilai_' . ($filterTipe ? ucfirst($filterTipe) . '_' : '') . now()->format('Y-m-d_H-i-s') . '.xlsx';

        return new StreamedResponse(function () use ($writer) {
            $writer->save('php://output');
        }, 200, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ]);
    }
}
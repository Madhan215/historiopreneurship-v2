<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnalisisKelompokKewirausahaan extends Model
{
    use HasFactory;
    protected $table = 'analisis_kelompok_kewirausahaan';
    protected $primaryKey = 'id_tabel_kelompok';
    public $timestamps = false; // Nonaktifkan penggunaan timestamps
    protected $fillable = ['id_kelompok','kategori','aspek','jawaban','created_at','created_by'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;
    protected $table = 'nilai';
    // protected $primaryKey = 'id_soal';

    protected $fillable = [
        'email',
        'id_soal',
        'aspek',
        'data_jawaban_penilai',
        'nilai_akhir',
        'percobaan_ke',
        'lama_waktu_pengerjaan',
        'waktu_selesai',
    ];

    public $timestamps = false;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormKelayakan extends Model
{
    use HasFactory;
    protected $table = 'form_kelayakan';

    // Tentukan kolom yang dapat diisi secara massal
    protected $fillable = [
        'aspect',      // Aspek yang dinilai
        'sub_aspect',  // Sub-aspek yang dinilai
        'score',       // Skor yang diberikan (1-5)
        'reason',      // Alasan penilaian
        'email'        // Email
    ];
}

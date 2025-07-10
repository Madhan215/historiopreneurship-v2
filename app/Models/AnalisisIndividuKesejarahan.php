<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnalisisIndividuKesejarahan extends Model
{
    use HasFactory;
    // Nama tabel
    protected $table = 'analisis_individu_kesejarahan';

    // Primary Key
    protected $primaryKey = 'id_jawaban';

    public $timestamps = false; // Nonaktifkan penggunaan timestamps
    // Kolom yang dapat diisi
    protected $fillable = [
        'aspek',
        'jawaban',
        'created_at',
        'created_by',
    ];
}

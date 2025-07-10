<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnalisisIndividuKesejeranhanII extends Model
{
    use HasFactory;

    protected $table = 'analisis_individu_kesejarahanii';
    protected $primaryKey = 'id_tabel_individu';
    public $timestamps = false; // Nonaktifkan penggunaan timestamps
    protected $fillable = ['no_objek','jawaban', 'created_at', 'created_by',];

}


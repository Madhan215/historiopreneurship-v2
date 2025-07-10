<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refleksi extends Model
{
    use HasFactory;
    protected $table = 'jawaban_refleksi';
    protected $primaryKey = 'id_tabel_refleksi_kesejarahan';
    public $timestamps = false;

    protected $fillable = [
        'respon',
        'kategori',
        'aspek',
        'jawaban',
        'created_by',
        'created_at',
    ];
}

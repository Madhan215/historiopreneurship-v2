<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AksesHalaman extends Model
{
    use HasFactory;
    protected $table = 'akses_halaman';

    protected $fillable = [
        'email',
        'materi_a',
        'materi_b',
        'materi_c',
        'created_at',
        'updated_by',
    ];
}

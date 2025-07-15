<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManajemenKonten extends Model
{
    protected $table = 'manajemen_konten';

    protected $fillable = [
        'kategori_konten',
        'nomor',
        'konten'
    ];
}

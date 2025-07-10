<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    use HasFactory;
    protected $table = 'badge';

    protected $fillable = [
        'link_gambar',
        'deskripsi',
    ];
    public $timestamps = false;

    
    
}

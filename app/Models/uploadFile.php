<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class uploadFile extends Model
{
    use HasFactory;
    protected $table = 'upload_file_tugas';

    // Primary key
    protected $primaryKey = 'id_upload_tabel';

    // Fillable attributes
    protected $fillable = [
        'file_path',
        'original_name',
        'mime_type',
        'size',
        'created_by',
        'kategori', // Nilai default null akan dikelola di migrasi atau controller
    ];

    // Default attributes
    protected $attributes = [
        'kategori' => null, // Set default value to null
    ];
}

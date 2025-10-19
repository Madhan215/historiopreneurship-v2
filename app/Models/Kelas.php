<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $table = 'kelas';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'nama_kelas',
        'kode_kelas',
        'deskripsi_kelas',
        'created_by'
    ];

    public function guru()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class topikdinamis extends Model
{
    use HasFactory;
    protected $table = 'topikdinamis';
    protected $primaryKey = 'id_topik';
    protected $fillable = ['nama_topik', 'status', 'urutan','token_kelas'];

    // Materi terkait topik, diurutkan berdasarkan kolom urutan
    public function materi()
    {
        return $this->hasMany(materiDinamis::class, 'id_topik', 'id_topik')->orderBy('urutan');
    }

    public function evaluasi()
    {
        return $this->hasMany(evaluasiDinamis::class, 'id_topik', 'id_topik')->orderBy('urutan');
    }

    public function upload()
    {
        return $this->hasMany(uploadDinamis::class, 'id_topik', 'id_topik')->orderBy('urutan');
    }
    public function users()
    {
        return $this->hasMany(User::class, 'email', 'email'); // Sesuaikan jika kolom yang digunakan berbeda
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelompok extends Model
{
    use HasFactory;
    protected $table = 'kelompok';
    protected $primaryKey = 'id_tabel_kelompok';
    public $timestamps = false;
    protected $fillable = ['email', 'id_kelompok'];

    public function users()
    {
        return $this->hasMany(User::class, 'email', 'email'); // Sesuaikan jika kolom yang digunakan berbeda
    }

    
}

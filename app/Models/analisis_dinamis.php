<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class analisis_dinamis extends Model
{
    protected $table = 'analisisdinamis';
    protected $primaryKey = 'id_analisis';
    public $timestamps = false;
    protected $fillable = ['id_analisis', 'nama_analisis', 'konten', 'status', 'urutan'];
    public function topik()
    {
        return $this->belongsTo(topikdinamis::class, 'id_topik', 'id_topik');
    }
}

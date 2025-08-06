<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class evaluasiDinamis extends Model
{
    use HasFactory;
    protected $table = 'evaluasidinamis';
    protected $primaryKey = 'id_evaluasi';
    public $timestamps = false;
    protected $fillable = ['id_topik', 'nama_evaluasi', 'konten', 'status','urutan'];

    public function topik()
    {
        return $this->belongsTo(topikdinamis::class, 'id_topik', 'id_topik');
    }
}
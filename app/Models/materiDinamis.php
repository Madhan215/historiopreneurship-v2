<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class materiDinamis extends Model
{
    use HasFactory;
    protected $table = 'materidinamis';
    protected $primaryKey = 'id_materi';
    public $timestamps = false;
    protected $fillable = ['id_topik', 'nama_materi', 'konten', 'status','urutan'];
    public function topik()
    {
        return $this->belongsTo(topikdinamis::class, 'id_topik', 'id_topik');
    }
}

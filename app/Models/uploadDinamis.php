<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class uploadDinamis extends Model
{
    use HasFactory;
    protected $table = 'uploaddinamis';
    protected $primaryKey = 'id_upload';
    public $timestamps = false;
    protected $fillable = ['id_topik', 'nama_upload', 'konten', 'status','urutan','deskripsi'];
    public function topik()
    {
        return $this->belongsTo(topikdinamis::class, 'id_topik', 'id_topik');
    }
}
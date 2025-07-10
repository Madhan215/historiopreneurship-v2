<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userBadge extends Model
{
    use HasFactory;
    protected $table = 'user_badge';

    protected $fillable = [
        'email',
        'id_badge',
        'status'
    ];
    public $timestamps = false;
}

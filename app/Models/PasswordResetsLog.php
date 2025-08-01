<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PasswordResetsLog extends Model
{
    use HasFactory;

    protected $table = 'password_resets_log';

    protected $fillable = [
        'user_id',
        'new_password_hash',
        'user_changed_password',
    ];

    protected $casts = [
        'user_changed_password' => 'boolean',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Kelompok;
use App\Models\PasswordResetsLog;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_lengkap',
        'no_hp',
        'alamat',
        'peran',
        'nim',
        'email',
        'password',
        'kelas',
        'jenis_kelamin',
        'profile_photo'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'token_kelas'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'token_kelas' => 'array',
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the kelompok that owns the user.
     */
    public function kelompok()
    {
        return $this->hasOne(Kelompok::class, 'email', 'email');
    }

    public function profilePhotoUrl(): Attribute
    {
        return Attribute::get(
            fn() =>
            $this->profile_photo
            ? asset('storage/' . $this->profile_photo)
            : asset('img/avatars/default-avatar.png')
        );
    }

    public function passwordResetsLog()
    {
        return $this->hasOne(PasswordResetsLog::class);
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::create([
            'nama_lengkap' => 'Siswa',
            'peran' => 'siswa',
            'email' => 'siswa@gmail.com',
            'password' => Hash::make('12345678')
        ]);

        User::create([
            'nama_lengkap' => 'Siswa1',
            'peran' => 'siswa',
            'email' => 'siswa1@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        User::create([
            'nama_lengkap' => 'Siswa2',
            'peran' => 'siswa',
            'email' => 'siswa2@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

    }
}

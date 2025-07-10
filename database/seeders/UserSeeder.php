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
            'no_hp' => '083',
            'peran' => 'siswa',
            'kelas' => 'A1',
            'email' => 'siswa@gmail.com',
            'password' => Hash::make('12345678'),
            'alamat' => 'Dijalan'
        ]);
        
        User::create([
            'nama_lengkap' => 'Siswa1',
            'no_hp' => '0831',
            'peran' => 'siswa',
            'kelas' => 'A1',
            'email' => 'siswa1@gmail.com',
            'password' => Hash::make('12345678'),
            'alamat' => 'Dijalan'
        ]);

        User::create([
            'nama_lengkap' => 'Siswa2',
            'no_hp' => '0832',
            'peran' => 'siswa',
            'kelas' => 'A1',
            'email' => 'siswa2@gmail.com',
            'password' => Hash::make('12345678'),
            'alamat' => 'Dijalan'
        ]);

    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserRealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::create([
        //     'nama_lengkap' => 'Administrator',
        //     'no_hp' => '081',
        //     'peran' => 'admin',
        //     'email' => 'admin@gmail.com',
        //     'password' => Hash::make('12345678'),
        //     'alamat' => 'Dijalan'
        // ]);

        User::create([
            'nama_lengkap' => 'Guru',
            'no_hp' => '082',
            'peran' => 'guru',
            'email' => 'guru@gmail.com',
            'password' => Hash::make('123456789'),
            'alamat' => 'Dijalan'
        ]);
        // User::create([
        //     'nama_lengkap' => 'Madhan',
        //     'no_hp' => '0811',
        //     'peran' => 'siswa',
        //     'kelas' => 'A1',
        //     'email' => 'madhan@gmail.com',
        //     'password' => Hash::make('12345678'),
        //     'alamat' => 'Jalan',
        //     'jenis_kelamin' => 'L',
        //     'poin' => 2134,
        // ]);
        // User::create([
        //     'nama_lengkap' => 'Salman',
        //     'no_hp' => '0812',
        //     'peran' => 'siswa',
        //     'kelas' => 'A1',
        //     'email' => 'salman@gmail.com',
        //     'password' => Hash::make('12345678'),
        //     'alamat' => 'Jalan',
        //     'jenis_kelamin' => 'L',
        //     'poin' => 2130,
        // ]);
        // User::create([
        //     'nama_lengkap' => 'Husna',
        //     'no_hp' => '0813',
        //     'peran' => 'siswa',
        //     'kelas' => 'A1',
        //     'email' => 'husna@gmail.com',
        //     'password' => Hash::make('12345678'),
        //     'alamat' => 'Jalan',
        //     'jenis_kelamin' => 'P',
        //     'poin' => 2122,
        // ]);
        // User::create([
        //     'nama_lengkap' => 'Iif',
        //     'no_hp' => '0814',
        //     'peran' => 'siswa',
        //     'kelas' => 'A1',
        //     'email' => 'iif@gmail.com',
        //     'password' => Hash::make('12345678'),
        //     'alamat' => 'Jalan',
        //     'jenis_kelamin' => 'P',
        //     'poin' => 2120,
        // ]);
        // User::create([
        //     'nama_lengkap' => 'Rifqi',
        //     'no_hp' => '0815',
        //     'peran' => 'siswa',
        //     'kelas' => 'A2',
        //     'email' => 'rifqi@gmail.com',
        //     'password' => Hash::make('12345678'),
        //     'alamat' => 'Jalan',
        //     'jenis_kelamin' => 'L',
        //     'poin' => 2103,
        // ]);
        // User::create([
        //     'nama_lengkap' => 'Ari',
        //     'no_hp' => '0816',
        //     'peran' => 'siswa',
        //     'kelas' => 'A2',
        //     'email' => 'ari@gmail.com',
        //     'password' => Hash::make('12345678'),
        //     'alamat' => 'Jalan',
        //     'jenis_kelamin' => 'L',
        //     'poin' => 2078,
        // ]);
        // User::create([
        //     'nama_lengkap' => 'Fadhil',
        //     'no_hp' => '0817',
        //     'peran' => 'siswa',
        //     'kelas' => 'A2',
        //     'email' => 'fadhil@gmail.com',
        //     'password' => Hash::make('12345678'),
        //     'alamat' => 'Jalan',
        //     'jenis_kelamin' => 'L',
        //     'poin' => 2068,
        // ]);
        // User::create([
        //     'nama_lengkap' => 'Fajar',
        //     'no_hp' => '0818',
        //     'peran' => 'siswa',
        //     'kelas' => 'A2',
        //     'email' => 'fajar@gmail.com',
        //     'password' => Hash::make('12345678'),
        //     'alamat' => 'Jalan',
        //     'jenis_kelamin' => 'L',
        //     'poin' => 2000,
        // ]);
        // User::create([
        //     'nama_lengkap' => 'Saipul',
        //     'no_hp' => '0819',
        //     'peran' => 'siswa',
        //     'kelas' => 'A2',
        //     'email' => 'saipul@gmail.com',
        //     'password' => Hash::make('12345678'),
        //     'alamat' => 'Jalan',
        //     'jenis_kelamin' => 'L',
        //     'poin' => 1994,
        // ]);
        // User::create([
        //     'nama_lengkap' => 'Fuad',
        //     'no_hp' => '0810',
        //     'peran' => 'siswa',
        //     'kelas' => 'A1',
        //     'email' => 'fuad@gmail.com',
        //     'password' => Hash::make('12345678'),
        //     'alamat' => 'Jalan',
        //     'jenis_kelamin' => 'L',
        //     'poin' => 1800,
        // ]);

        // 20 User untuk Uji Lapangan
        User::create([
            'nama_lengkap' => 'User 1',
            'no_hp' => '08511',
            'peran' => 'siswa',
            'kelas' => 'A1',
            'email' => 'user1@gmail.com',
            'password' => Hash::make('12345678'),
            'alamat' => 'Jalan',
            'poin' => 0,
        ]);
        User::create([
            'nama_lengkap' => 'User 2',
            'no_hp' => '08512',
            'peran' => 'siswa',
            'kelas' => 'A1',
            'email' => 'user2@gmail.com',
            'password' => Hash::make('12345678'),
            'alamat' => 'Jalan',
            'poin' => 0,
        ]);
        User::create([
            'nama_lengkap' => 'User 3',
            'no_hp' => '08513',
            'peran' => 'siswa',
            'kelas' => 'A1',
            'email' => 'user3@gmail.com',
            'password' => Hash::make('12345678'),
            'alamat' => 'Jalan',
            'poin' => 0,
        ]);
        User::create([
            'nama_lengkap' => 'User 4',
            'no_hp' => '08514',
            'peran' => 'siswa',
            'kelas' => 'A1',
            'email' => 'user4@gmail.com',
            'password' => Hash::make('12345678'),
            'alamat' => 'Jalan',
            'poin' => 0,
        ]);
        User::create([
            'nama_lengkap' => 'User 5',
            'no_hp' => '08515',
            'peran' => 'siswa',
            'kelas' => 'A1',
            'email' => 'user5@gmail.com',
            'password' => Hash::make('12345678'),
            'alamat' => 'Jalan',
            'poin' => 0,
        ]);
        User::create([
            'nama_lengkap' => 'User 6',
            'no_hp' => '08516',
            'peran' => 'siswa',
            'kelas' => 'A1',
            'email' => 'user6@gmail.com',
            'password' => Hash::make('12345678'),
            'alamat' => 'Jalan',
            'poin' => 0,
        ]);
        User::create([
            'nama_lengkap' => 'User 7',
            'no_hp' => '08517',
            'peran' => 'siswa',
            'kelas' => 'A1',
            'email' => 'user7@gmail.com',
            'password' => Hash::make('12345678'),
            'alamat' => 'Jalan',
            'poin' => 0,
        ]);
        User::create([
            'nama_lengkap' => 'User 8',
            'no_hp' => '08518',
            'peran' => 'siswa',
            'kelas' => 'A1',
            'email' => 'user8@gmail.com',
            'password' => Hash::make('12345678'),
            'alamat' => 'Jalan',
            'poin' => 0,
        ]);
        User::create([
            'nama_lengkap' => 'User 9',
            'no_hp' => '08519',
            'peran' => 'siswa',
            'kelas' => 'A1',
            'email' => 'user9@gmail.com',
            'password' => Hash::make('12345678'),
            'alamat' => 'Jalan',
            'poin' => 0,
        ]);
        User::create([
            'nama_lengkap' => 'User 10',
            'no_hp' => '085110',
            'peran' => 'siswa',
            'kelas' => 'A1',
            'email' => 'user10@gmail.com',
            'password' => Hash::make('12345678'),
            'alamat' => 'Jalan',
            'poin' => 0,
        ]);
        // A2
        User::create([
            'nama_lengkap' => 'User 11',
            'no_hp' => '085111',
            'peran' => 'siswa',
            'kelas' => 'A2',
            'email' => 'user11@gmail.com',
            'password' => Hash::make('12345678'),
            'alamat' => 'Jalan',
            'poin' => 0,
        ]);
        User::create([
            'nama_lengkap' => 'User 12',
            'no_hp' => '085122',
            'peran' => 'siswa',
            'kelas' => 'A2',
            'email' => 'user12@gmail.com',
            'password' => Hash::make('12345678'),
            'alamat' => 'Jalan',
            'poin' => 0,
        ]);
        User::create([
            'nama_lengkap' => 'User 13',
            'no_hp' => '085133',
            'peran' => 'siswa',
            'kelas' => 'A2',
            'email' => 'user13@gmail.com',
            'password' => Hash::make('12345678'),
            'alamat' => 'Jalan',
            'poin' => 0,
        ]);
        User::create([
            'nama_lengkap' => 'User 14',
            'no_hp' => '085144',
            'peran' => 'siswa',
            'kelas' => 'A2',
            'email' => 'user14@gmail.com',
            'password' => Hash::make('12345678'),
            'alamat' => 'Jalan',
            'poin' => 0,
        ]);
        User::create([
            'nama_lengkap' => 'User 15',
            'no_hp' => '085155',
            'peran' => 'siswa',
            'kelas' => 'A2',
            'email' => 'user15@gmail.com',
            'password' => Hash::make('12345678'),
            'alamat' => 'Jalan',
            'poin' => 0,
        ]);
        User::create([
            'nama_lengkap' => 'User 16',
            'no_hp' => '085166',
            'peran' => 'siswa',
            'kelas' => 'A2',
            'email' => 'user16@gmail.com',
            'password' => Hash::make('12345678'),
            'alamat' => 'Jalan',
            'poin' => 0,
        ]);
        User::create([
            'nama_lengkap' => 'User 17',
            'no_hp' => '085177',
            'peran' => 'siswa',
            'kelas' => 'A2',
            'email' => 'user17@gmail.com',
            'password' => Hash::make('12345678'),
            'alamat' => 'Jalan',
            'poin' => 0,
        ]);
        User::create([
            'nama_lengkap' => 'User 18',
            'no_hp' => '085188',
            'peran' => 'siswa',
            'kelas' => 'A2',
            'email' => 'user18@gmail.com',
            'password' => Hash::make('12345678'),
            'alamat' => 'Jalan',
            'poin' => 0,
        ]);
        User::create([
            'nama_lengkap' => 'User 19',
            'no_hp' => '085199',
            'peran' => 'siswa',
            'kelas' => 'A2',
            'email' => 'user19@gmail.com',
            'password' => Hash::make('12345678'),
            'alamat' => 'Jalan',
            'poin' => 0,
        ]);
        User::create([
            'nama_lengkap' => 'User 20',
            'no_hp' => '085120',
            'peran' => 'siswa',
            'kelas' => 'A2',
            'email' => 'user20@gmail.com',
            'password' => Hash::make('12345678'),
            'alamat' => 'Jalan',
            'poin' => 0,
        ]);
        
    }
}

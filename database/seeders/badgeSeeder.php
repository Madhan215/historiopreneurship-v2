<?php

namespace Database\Seeders;

use App\Models\Badge;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class badgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Badge::create([
            'link_gambar' => 'img/high_rank.png',
            'deskripsi' => 'High Rank',
        ]);

        Badge::create([
            'link_gambar' => 'img/master.png',
            'deskripsi' => 'Master',
        ]);

        Badge::create([
            'link_gambar' => 'img/pembelajar_cepat.png',
            'deskripsi' => 'Pembelajar Cepat',
        ]);

        Badge::create([
            'link_gambar' => 'img/PenguasaMateri_gold.png',
            'deskripsi' => 'Penguasa Materi Gold',
        ]);
        Badge::create([
            'link_gambar' => 'img/PenguasaMateri_silver.png',
            'deskripsi' => 'Penguasa Materi Silver',
        ]);
        Badge::create([
            'link_gambar' => 'img/PenguasaMateri_bronze.png',
            'deskripsi' => 'Penguasa Materi Bronze',
        ]);
    }
}

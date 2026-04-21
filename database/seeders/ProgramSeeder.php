<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramSeeder extends Seeder
{
    public function run(): void
    {
        $programs = [
            [
                'title' => 'Kurikulum Merdeka',
                'description' => 'Implementasi Kurikulum Merdeka yang berpusat pada siswa dengan pendekatan diferensiasi dan project-based learning untuk mengoptimalkan potensi setiap peserta didik.',
                'icon' => 'fas fa-book-open',
                'order' => 1,
            ],
            [
                'title' => 'Tahfidz Al-Quran',
                'description' => 'Program menghafal Al-Quran dengan target minimal 3 juz selama masa studi, dibimbing oleh hafidz/hafidzah berpengalaman dengan metode talaqqi.',
                'icon' => 'fas fa-quran',
                'order' => 2,
            ],
            [
                'title' => 'Bilingual Program',
                'description' => 'Program dwibahasa Indonesia-Inggris untuk mempersiapkan siswa menghadapi tantangan global dengan kemampuan komunikasi internasional yang mumpuni.',
                'icon' => 'fas fa-language',
                'order' => 3,
            ],
            [
                'title' => 'STEM Education',
                'description' => 'Pembelajaran terintegrasi Sains, Teknologi, Engineering, dan Matematika melalui eksperimen, robotika, dan proyek inovatif.',
                'icon' => 'fas fa-flask',
                'order' => 4,
            ],
            [
                'title' => 'Seni & Budaya',
                'description' => 'Pengembangan bakat seni melalui kaligrafi, nasyid, tari tradisional, dan teater sebagai wadah ekspresi kreativitas siswa.',
                'icon' => 'fas fa-palette',
                'order' => 5,
            ],
            [
                'title' => 'Leadership Camp',
                'description' => 'Pelatihan kepemimpinan rutin di alam terbuka untuk membangun karakter, kerjasama tim, dan mental tangguh para calon pemimpin masa depan.',
                'icon' => 'fas fa-campground',
                'order' => 6,
            ],
        ];

        foreach ($programs as $program) {
            DB::table('programs')->insert(array_merge($program, [
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
};
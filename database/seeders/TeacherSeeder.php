<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeacherSeeder extends Seeder
{
    public function run(): void
    {
        $teachers = [
            ['name' => 'Dr. H. Ahmad Fauzi, M.Pd.I', 'position' => 'Kepala Sekolah', 'type' => 'guru', 'order' => 1, 'bio' => 'Pemimpin visioner dengan pengalaman 20 tahun di dunia pendidikan. Lulusan UIN Syarif Hidayatullah Jakarta.'],
            ['name' => 'Hj. Siti Aisyah, S.Pd.', 'position' => 'Wakil Kepala Sekolah Kurikulum', 'type' => 'guru', 'order' => 2, 'bio' => 'Ahli pengembangan kurikulum dengan sertifikasi pendidik profesional.'],
            ['name' => 'Ustadz Muhammad Rizki, Lc.', 'position' => 'Wakil Kepala Sekolah Kesiswaan', 'type' => 'guru', 'order' => 3, 'bio' => 'Lulusan Universitas Al-Azhar, Kairo. Spesialis pembinaan karakter islami.'],
            ['name' => 'Ir. Bambang Hartono, M.T.', 'position' => 'Guru Matematika & STEM', 'type' => 'guru', 'order' => 4, 'bio' => 'Peraih penghargaan guru berprestasi tingkat nasional bidang sains.'],
            ['name' => 'Dewi Lestari, S.S., M.Hum.', 'position' => 'Guru Bahasa Inggris', 'type' => 'guru', 'order' => 5, 'bio' => 'IELTS certified, pengalaman mengajar bilingual selama 12 tahun.'],
            ['name' => 'Rahmat Hidayat, S.Pd.', 'position' => 'Guru Tahfidz', 'type' => 'guru', 'order' => 6, 'bio' => 'Hafidz 30 juz, lulusan Universitas Islam Madinah.'],
            ['name' => 'Rina Marlina, S.Kom.', 'position' => 'Staff TU', 'type' => 'staff', 'order' => 7, 'bio' => 'Bertanggung jawab atas administrasi dan keuangan sekolah.'],
            ['name' => 'Agus Supriyadi', 'position' => 'Staff Perpustakaan', 'type' => 'staff', 'order' => 8, 'bio' => 'Mengelola koleksi perpustakaan dengan lebih dari 10.000 buku.'],
        ];

        foreach ($teachers as $teacher) {
            DB::table('teachers')->insert(array_merge($teacher, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
};
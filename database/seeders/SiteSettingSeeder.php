<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['key' => 'school_name', 'value' => 'Sekolah Unggulan Indonesia'],
            ['key' => 'school_short_name', 'value' => 'SUI'],
            ['key' => 'school_motto', 'value' => 'Unggul dalam Ilmu, Berkarakter Islami'],
            ['key' => 'school_address', 'value' => 'Jl. Pendidikan No. 1, Kecamatan Cendekia, Jakarta Selatan 12345'],
            ['key' => 'school_phone', 'value' => '(021) 1234-5678'],
            ['key' => 'school_email', 'value' => 'info@sekolahunggulan.id'],
            ['key' => 'school_facebook', 'value' => 'https://facebook.com/sekolahunggulan'],
            ['key' => 'school_instagram', 'value' => 'https://instagram.com/sekolahunggulan'],
            ['key' => 'school_youtube', 'value' => 'https://youtube.com/@sekolahunggulan'],
            ['key' => 'ppdb_info', 'value' => 'Pendaftaran PPDB Tahun Ajaran 2025/2026 dibuka mulai 1 Januari - 30 Juni 2025. Kuota terbatas!'],
            ['key' => 'headmaster_welcome', 'value' => 'Assalamualaikum Warahmatullahi Wabarakatuh. Segala puji bagi Allah SWT yang telah memberikan rahmat dan karunia-Nya. Selamat datang di website resmi Sekolah Unggulan Indonesia. Kami berkomitmen untuk mencetak generasi yang tidak hanya cerdas secara akademis, tetapi juga memiliki akhlak mulia dan jiwa kepemimpinan. Semoga website ini dapat menjadi sarana informasi yang bermanfaat bagi seluruh civitas akademika dan masyarakat.'],
        ];

        foreach ($settings as $setting) {
            DB::table('site_settings')->insert([
                'key' => $setting['key'],
                'value' => $setting['value'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
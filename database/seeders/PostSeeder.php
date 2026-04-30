<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $posts = [
            [
                'title' => 'Penerimaan Peserta Didik Baru Tahun Ajaran 2025/2026 Telah Dibuka',
                'slug' => 'spmb-tahun-ajaran-2025-2026-dibuka',
                'content' => '<p>Alhamdulillah, dengan memohon ridho Allah SWT, Sekolah Unggulan Indonesia resmi membuka pendaftaran SPMB untuk tahun ajaran 2025/2026. Pendaftaran dibuka mulai 1 Januari hingga 30 Juni 2025.</p><p>Tahun ini kami membuka kuota untuk:</p><ul><li>Kelas 7 SMP: 120 siswa (4 rombel)</li><li>Kelas 10 SMA: 144 siswa (4 rombel)</li></ul><p>Persyaratan umum meliputi: ijazah/SKHUN, akta kelahiran, kartu keluarga, pas foto 3x4 (4 lembar), surat keterangan sehat, dan nilai rapor semester 1-5.</p><p>Untuk informasi lebih lanjut, silakan hubungi panitia SPMB di nomor (021) 1234567 atau datang langsung ke sekolah.</p>',
                'excerpt' => 'Pendaftaran peserta didik baru untuk tahun ajaran 2025/2026 resmi dibuka. Kuota terbatas!',
                'is_published' => true,
            ],
            [
                'title' => 'Siswa Raih Juara 1 Olimpiade Sains Tingkat Provinsi',
                'slug' => 'juara-1-olimpiade-sains-tingkat-provinsi',
                'content' => '<p>Membanggakan! Muhammad Farhan, siswa kelas 11 IPA, berhasil meraih juara 1 dalam Olimpiade Sains Nasional (OSN) tingkat Provinsi DKI Jakarta cabang Fisika.</p><p>Prestasi ini merupakan buah dari pembinaan intensif selama 6 bulan di bawah bimbingan Bapak Ir. Bambang Hartono, M.T. Farhan akan mewakili provinsi di tingkat nasional pada bulan Oktober mendatang.</p><p>"Saya bersyukur dan tidak menyangka bisa sampai di titik ini. Terima kasih kepada guru-guru dan orang tua yang selalu mendukung," ujar Farhan usai menerima piala.</p><p>Kepala Sekolah, Dr. H. Ahmad Fauzi, M.Pd.I menyampaikan rasa bangga dan berharap prestasi ini menjadi motivasi bagi seluruh siswa.</p>',
                'excerpt' => 'Muhammad Farhan, siswa kelas 11 IPA, meraih juara 1 OSN tingkat provinsi cabang Fisika.',
                'is_published' => true,
            ],
            [
                'title' => 'Kegiatan Leadership Camp 2024 Sukses Digelar',
                'slug' => 'leadership-camp-2024-sukses',
                'content' => '<p>Kegiatan Leadership Camp tahunan yang diselenggarakan di Bumi Perkemahan Cibubur pada 15-17 November 2024 telah berlangsung sukses dengan diikuti oleh 200 peserta dari kelas 7 dan 10.</p><p>Berbagai kegiatan dilaksanakan meliputi: outbound, seminar kepemimpinan, orientasi alam, api unggun, dan presentasi proyek kelompok. Narasumber yang hadir antara lain Letkol (Purn) H. Syamsul Bahri dan Coach Dian Pratama.</p><p>"Kegiatan ini sangat bermanfaat. Saya belajar tentang kerjasama tim, keberanian, dan tanggung jawab," kata Zahra, siswi kelas 7.</p>',
                'excerpt' => 'Leadership Camp 2024 diikuti 200 peserta dan menghadirkan berbagai kegiatan menarik.',
                'is_published' => true,
            ],
            [
                'title' => 'MoU dengan Universitas Al-Azhar untuk Program Beasiswa',
                'slug' => 'mou-universitas-al-azhar-beasiswa',
                'content' => '<p>Sekolah Unggulan Indonesia menandatangani Nota Kesepahaman (MoU) dengan Universitas Al-Azhar, Kairo, Mesir, untuk program beasiswa lanjutan studi di universitas tertua di dunia tersebut.</p><p>Penandatanganan dilakukan oleh Kepala Sekolah Dr. H. Ahmad Fauzi, M.Pd.I dan perwakilan Rektor Universitas Al-Azhar di Jakarta pada Senin (20/11/2024).</p><p>Program ini memberikan kesempatan bagi 5 siswa terbaik setiap tahunnya untuk melanjutkan studi di berbagai fakultas di Universitas Al-Azhar dengan biaya penuh ditanggung.</p>',
                'excerpt' => 'MoU dengan Universitas Al-Azhar membuka peluang beasiswa bagi siswa terbaik.',
                'is_published' => true,
            ],
            [
                'title' => 'Renovasi Laboratorium Sains Rampung',
                'slug' => 'renovasi-laboratorium-sains-rampung',
                'content' => '<p>Renovasi besar-besaran laboratorium IPA yang memakan waktu 3 bulan telah rampung. Lab sains kini dilengkapi dengan peralatan modern termasuk mikroskop digital, set robotika, dan ruang eksperimen yang lebih luas.</p><p>Total investasi renovasi mencapai Rp 2,5 miliar yang berasal dari dana APBD dan donatur. Fasilitas baru ini diharapkan mampu mendukung program STEM Education yang menjadi unggulan sekolah.</p>',
                'excerpt' => 'Laboratorium IPA baru dengan fasilitas modern senilai Rp 2,5 miliar siap digunakan.',
                'is_published' => true,
            ],
        ];

        foreach ($posts as $post) {
            DB::table('posts')->insert(array_merge($post, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
};
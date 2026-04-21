<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'zidanherlangga24@gmail.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'role' => 'admin',
        ]);

        $this->call([
            ProgramSeeder::class,
            TeacherSeeder::class,
            PostSeeder::class,
            GallerySeeder::class,
            SiteSettingSeeder::class,
        ]);
    }
};
<?php

namespace App\Services;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class SettingService
{
    /**
     * Mengambil nilai setting. Aman dari crash jika tabel belum ada.
     */
    public function get(string $key, $default = null): ?string
    {
        try {
            // Gunakan withDefault() untuk menghindari error jika tabel cache bermasalah
            return Cache::remember("site_setting_{$key}", 3600, function () use ($key, $default) {
                return SiteSetting::where('key', $key)->value('value') ?? $default;
            });
        } catch (\Throwable $e) {
            // Jika error (misal: tabel cache/site_settings belum ada), 
            // kembalikan nilai default agar website tetap bisa jalan
            Log::warning("Gagal memuat setting '{$key}': " . $e->getMessage());
            return $default;
        }
    }

    /**
     * Menyimpan nilai setting.
     */
    public function set(string $key, $value): void
    {
        try {
            SiteSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
            
            try {
                Cache::forget("site_setting_{$key}");
            } catch (\Throwable $e) {
                // Abaikan error jika cache gagal dihapus
            }
        } catch (\Throwable $e) {
            Log::error("Gagal menyimpan setting '{$key}': " . $e->getMessage());
        }
    }

    /**
     * Mengambil semua setting dalam bentuk array.
     */
    public function getAll(): array
    {
        try {
            return SiteSetting::pluck('value', 'key')->toArray();
        } catch (\Throwable $e) {
            Log::warning("Gagal memuat semua setting: " . $e->getMessage());
            return []; // Kembalikan array kosong agar tidak crash
        }
    }
}
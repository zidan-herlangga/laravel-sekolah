<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'nisn',
        'school_origin',
        'phone',
        'email',
        'gender',
        'birth_date',
        'birth_place',
        'address',
        'parent_name',
        'parent_phone',
        'status',
        'notes',
        // Kolom Upload File & Verifikasi Dokumen
        'kartu_keluarga', 
        'ijazah', 
        'akte_kelahiran', 
        'documents_verified'
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'birth_date' => 'date',
        'status' => 'string',
        'documents_verified' => 'boolean',
    ];

    // =============================
    // LOCAL SCOPES
    // =============================

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeVerified($query)
    {
        return $query->where('status', 'verified');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    // =============================
    // ACCESSORS (Data Helper)
    // =============================

    /**
     * Mendapatkan label status dalam Bahasa Indonesia
     */
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'verified' => 'Terverifikasi',
            'rejected' => 'Ditolak',
            default => 'Menunggu Verifikasi', // 'pending'
        };
    }

    /**
     * Mendapatkan warna badge untuk status (CSS class)
     */
    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'verified' => 'success',
            'rejected' => 'danger',
            default => 'warning', // 'pending'
        };
    }

    /**
     * Mendapatkan label jenis kelamin
     */
    public function getGenderLabelAttribute(): string
    {
        // Tambahkan default untuk menghindari error jika gender null
        return match ($this->gender) {
            'L' => 'Laki-laki',
            'P' => 'Perempuan',
            default => '-',
        };
    }
    
    // Opsional: Helper untuk cek apakah dokumen lengkap
    public function getDocumentsCompleteAttribute(): bool
    {
        return !empty($this->kartu_keluarga) 
            && !empty($this->ijazah) 
            && !empty($this->akte_kelahiran);
    }
}
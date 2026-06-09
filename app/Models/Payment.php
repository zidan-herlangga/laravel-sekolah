<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_id',
        'user_id',
        'amount',
        'status',
        'method',
        'transaction_id',
        'snap_token',
        'paid_at',
        'expired_at',
        'raw_response',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'paid_at' => 'datetime',
        'expired_at' => 'datetime',
        'raw_response' => 'array',
    ];

    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeSuccess($query)
    {
        return $query->where('status', 'success');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'success' => 'Berhasil',
            'pending' => 'Menunggu',
            'expired' => 'Kedaluwarsa',
            'failed' => 'Gagal',
            default => 'Unknown',
        };
    }
}

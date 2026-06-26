<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Child extends Model
{
    protected $fillable = [
        'enrollment_id', 'name', 'birth_date', 'gender',
        'parent_name', 'parent_phone', 'allergies', 'status',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    public function enrollment(): BelongsTo
    {
        return $this->belongsTo(Enrollment::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function paymentDates(): HasMany
    {
        return $this->hasMany(PaymentDate::class);
    }

    public function scopeHarian($query)
    {
        return $query->whereHas('enrollment.package', fn($q) => $q->where('type', 'harian'));
    }

    public function scopeBulanan($query)
    {
        return $query->whereHas('enrollment.package', fn($q) => $q->where('type', 'bulanan'));
    }

    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    public function getStatusBadgeAttribute(): string
    {
        return match ($this->status) {
            'aktif' => 'success',
            'cuti' => 'warning',
            'sakit' => 'danger',
            'pindah' => 'info',
            'lulus' => 'secondary',
            default => 'secondary',
        };
    }
}

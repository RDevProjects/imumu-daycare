<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

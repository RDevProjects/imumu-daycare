<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Enrollment extends Model
{
    protected $fillable = [
        'registration_number', 'parent_name', 'parent_phone', 'parent_email',
        'child_name', 'child_age', 'child_gender', 'address',
        'package_id', 'payment_method', 'notes',
        'status', 'admin_notes', 'confirmed_by', 'confirmed_at', 'history_token',
    ];

    protected $casts = [
        'confirmed_at' => 'datetime',
    ];

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    public function confirmedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'confirmed_by');
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }

    public function child(): HasOne
    {
        return $this->hasOne(Child::class);
    }

    public function invoice(): HasOne
    {
        return $this->hasOne(Invoice::class);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    public function scopePaid($query)
    {
        return $query->where('status', 'paid');
    }

    public function getHistoryUrlAttribute(): string
    {
        return url('/riwayat/' . $this->history_token);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $fillable = ['bank_name', 'account_number', 'account_name', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function getDisplayAttribute(): string
    {
        return "{$this->bank_name} - {$this->account_number} a.n. {$this->account_name}";
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Agency extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'level',
        'total_commission',
        'approved_at',
        'approved_by'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function commissions(): HasMany
    {
        return $this->hasMany(AgencyCommission::class);
    }

    public function getCommissionRateAttribute(): float
    {
        return match($this->level) {
            1 => 0.10,
            2 => 0.08,
            3 => 0.06,
            4 => 0.04,
            5 => 0.02,
            default => 0.00,
        };
    }

    public function getMinimumOrderAmountAttribute(): float
    {
        return match($this->level) {
            1 => 50000000,
            2 => 40000000,
            3 => 30000000,
            4 => 20000000,
            5 => 10000000,
            default => 0,
        };
    }
}

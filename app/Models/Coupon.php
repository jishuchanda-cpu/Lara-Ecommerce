<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Coupon extends Model
{
    /** @use HasFactory<\Database\Factories\CouponFactory> */
    use HasFactory;

    protected $fillable = [
        'code',
        'description',
        'type',
        'value',
        'min_order_amount',
        'max_uses',
        'max_uses_per_user',
        'used_count',
        'starts_at',
        'expires_at',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'value' => 'decimal:2',
            'min_order_amount' => 'decimal:2',
            'starts_at' => 'datetime',
            'expires_at' => 'datetime',
            'is_active' => 'boolean',
            'max_uses' => 'integer',
            'max_uses_per_user' => 'integer',
            'used_count' => 'integer',
        ];
    }

    public function usages(): HasMany
    {
        return $this->hasMany(CouponUsage::class);
    }

    public function isValid(): bool
    {
        if (!$this->is_active) {
            return false;
        }

        if ($this->starts_at && now()->isBefore($this->starts_at)) {
            return false;
        }

        if ($this->expires_at && now()->isAfter($this->expires_at)) {
            return false;
        }

        if ($this->max_uses !== null && $this->used_count >= $this->max_uses) {
            return false;
        }

        return true;
    }

    public function isValidForUser(?User $user): bool
    {
        if (!$this->isValid()) {
            return false;
        }

        if ($user && $this->max_uses_per_user !== null) {
            $userUsageCount = $this->usages()->where('user_id', $user->id)->count();
            if ($userUsageCount >= $this->max_uses_per_user) {
                return false;
            }
        }

        return true;
    }

    public function isValidForOrder(float $subtotal, ?User $user = null): bool
    {
        if (!$this->isValidForUser($user)) {
            return false;
        }

        if ($this->min_order_amount > 0 && $subtotal < $this->min_order_amount) {
            return false;
        }

        return true;
    }

    public function calculateDiscount(float $subtotal): float
    {
        if (!$this->isValid()) {
            return 0;
        }

        if ($subtotal < $this->min_order_amount) {
            return 0;
        }

        if ($this->type === 'percentage') {
            return round($subtotal * ($this->value / 100), 2);
        }

        // Fixed amount
        return min($this->value, $subtotal);
    }

    public function formattedValue(): string
    {
        if ($this->type === 'percentage') {
            return (int) $this->value . '%';
        }

        return '$' . number_format($this->value, 2);
    }

    public function incrementUsage(): void
    {
        $this->increment('used_count');
    }
}

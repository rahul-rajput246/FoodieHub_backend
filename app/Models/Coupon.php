<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'description',
        'discount_type',
        'discount_value',
        'min_order_amount',
        'max_discount_amount',
        'usage_limit',
        'used_count',
        'user_limit',
        'valid_from',
        'valid_until',
        'is_active',
    ];

    protected $casts = [
        'discount_value' => 'float',
        'min_order_amount' => 'float',
        'max_discount_amount' => 'float',
        'usage_limit' => 'integer',
        'used_count' => 'integer',
        'user_limit' => 'integer',
        'is_active' => 'boolean',
        'valid_from' => 'datetime',
        'valid_until' => 'datetime',
    ];

    public function usages()
    {
        return $this->hasMany(CouponUsage::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function scopeActive($query)
    {
        $now = Carbon::now();
        return $query->where('is_active', true)
            ->where(function ($q) use ($now) {
                $q->whereNull('valid_from')->orWhere('valid_from', '<=', $now);
            })
            ->where(function ($q) use ($now) {
                $q->whereNull('valid_until')->orWhere('valid_until', '>=', $now);
            });
    }

    /**
     * Calculate discount for a given subtotal
     */
    public function calculateDiscount(float $subtotal): float
    {
        if ($subtotal <= 0) {
            return 0.0;
        }

        if ($this->discount_type === 'percentage') {
            $discount = ($subtotal * $this->discount_value) / 100;
            if ($this->max_discount_amount && $discount > $this->max_discount_amount) {
                $discount = $this->max_discount_amount;
            }
        } else {
            // Fixed discount
            $discount = min($this->discount_value, $subtotal);
        }

        return round(max(0, $discount), 2);
    }

    /**
     * Validate coupon eligibility for an order subtotal and user
     */
    public function validateFor(float $subtotal, ?int $userId = null): array
    {
        if (!$this->is_active) {
            return [
                'valid' => false,
                'message' => "Coupon '{$this->code}' is currently inactive.",
            ];
        }

        $now = Carbon::now();
        if ($this->valid_from && $now->lt($this->valid_from)) {
            return [
                'valid' => false,
                'message' => "Coupon '{$this->code}' is not active yet.",
            ];
        }

        if ($this->valid_until && $now->gt($this->valid_until)) {
            return [
                'valid' => false,
                'message' => "Coupon '{$this->code}' has expired on " . $this->valid_until->format('d M Y') . ".",
            ];
        }

        if ($this->usage_limit !== null && $this->used_count >= $this->usage_limit) {
            return [
                'valid' => false,
                'message' => "Coupon '{$this->code}' has reached its maximum total usage limit.",
            ];
        }

        if ($this->min_order_amount > 0 && $subtotal < $this->min_order_amount) {
            $needed = round($this->min_order_amount - $subtotal, 2);
            return [
                'valid' => false,
                'message' => "Minimum order of ₹{$this->min_order_amount} required to use '{$this->code}'. Add ₹{$needed} more to qualify!",
            ];
        }

        if ($userId && $this->user_limit > 0) {
            $userUsage = $this->usages()->where('user_id', $userId)->count();
            if ($userUsage >= $this->user_limit) {
                return [
                    'valid' => false,
                    'message' => "You have already used coupon '{$this->code}' the maximum allowed times.",
                ];
            }
        }

        $discount = $this->calculateDiscount($subtotal);

        return [
            'valid' => true,
            'discount' => $discount,
            'message' => "Coupon '{$this->code}' applied successfully! You saved ₹{$discount}.",
        ];
    }
}

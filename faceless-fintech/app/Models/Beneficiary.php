<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Beneficiary extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'type',
        'account_name',
        'account_number',
        'bank_name',
        'account_type',
        'routing_number',
        'bank_address',
        'country',
        'swift_code',
        'iban',
        'crypto_currency',
        'crypto_network',
        'wallet_address',
        'paypal_email',
        'wise_email',
        'skrill_email',
        'venmo_username',
        'venmo_phone',
        'zelle_email',
        'zelle_phone',
        'cashapp_tag',
        'revolut_email',
        'alipay_id',
        'wechat_id',
        'method_type',
        'initials',
        'color',
        'is_favorite',
        'usage_count',
        'last_used_at'
    ];

    protected $casts = [
        'is_favorite' => 'boolean',
        'last_used_at' => 'datetime',
    ];

    /**
     * Get the user that owns the beneficiary
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Generate initials from the beneficiary name
     */
    public function generateInitials(): string
    {
        $words = explode(' ', trim($this->name));
        if (count($words) >= 2) {
            return strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1));
        }
        return strtoupper(substr($this->name, 0, 2));
    }

    /**
     * Get a random color for the avatar
     */
    public static function getRandomColor(): string
    {
        $colors = [
            'bg-blue-500',
            'bg-green-500',
            'bg-purple-500',
            'bg-orange-500',
            'bg-red-500',
            'bg-indigo-500',
            'bg-pink-500',
            'bg-teal-500',
            'bg-cyan-500',
            'bg-amber-500'
        ];
        
        return $colors[array_rand($colors)];
    }

    /**
     * Increment usage count and update last used timestamp
     */
    public function incrementUsage(): void
    {
        $this->increment('usage_count');
        $this->update(['last_used_at' => now()]);
    }

    /**
     * Get the primary identifier for this beneficiary based on type
     */
    public function getPrimaryIdentifierAttribute(): string
    {
        switch ($this->type) {
            case 'local':
                return $this->account_number ?? 'N/A';
            case 'international':
                switch ($this->method_type) {
                    case 'Wire Transfer':
                        return $this->account_number ?? $this->iban ?? 'N/A';
                    case 'Cryptocurrency':
                        return substr($this->wallet_address, 0, 10) . '...' ?? 'N/A';
                    case 'PayPal':
                        return $this->paypal_email ?? 'N/A';
                    case 'Wise Transfer':
                        return $this->wise_email ?? 'N/A';
                    case 'Skrill':
                        return $this->skrill_email ?? 'N/A';
                    case 'Venmo':
                        return $this->venmo_username ?? $this->venmo_phone ?? 'N/A';
                    case 'Zelle':
                        return $this->zelle_email ?? $this->zelle_phone ?? 'N/A';
                    case 'Cash App':
                        return $this->cashapp_tag ?? 'N/A';
                    case 'Revolut':
                        return $this->revolut_email ?? 'N/A';
                    case 'Alipay':
                        return $this->alipay_id ?? 'N/A';
                    case 'WeChat Pay':
                        return $this->wechat_id ?? 'N/A';
                    default:
                        return 'N/A';
                }
            default:
                return 'N/A';
        }
    }

    /**
     * Get the secondary info for display
     */
    public function getSecondaryInfoAttribute(): string
    {
        switch ($this->type) {
            case 'local':
                return $this->bank_name ?? 'Local Bank';
            case 'international':
                switch ($this->method_type) {
                    case 'Wire Transfer':
                        return $this->bank_name ?? 'International Bank';
                    case 'Cryptocurrency':
                        return $this->crypto_currency . ' (' . $this->crypto_network . ')';
                    default:
                        return $this->method_type ?? 'International';
                }
            default:
                return 'Unknown';
        }
    }

    /**
     * Scope to get beneficiaries by type
     */
    public function scopeByType($query, string $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope to get favorite beneficiaries
     */
    public function scopeFavorites($query)
    {
        return $query->where('is_favorite', true);
    }

    /**
     * Scope to get most used beneficiaries
     */
    public function scopeMostUsed($query, int $limit = 10)
    {
        return $query->orderBy('usage_count', 'desc')
                    ->orderBy('last_used_at', 'desc')
                    ->limit($limit);
    }

    /**
     * Boot method to set default values
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($beneficiary) {
            if (empty($beneficiary->initials)) {
                $beneficiary->initials = $beneficiary->generateInitials();
            }
            if (empty($beneficiary->color)) {
                $beneficiary->color = self::getRandomColor();
            }
        });
    }
} 
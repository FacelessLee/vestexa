<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'card_number',
        'card_holder_name',
        'expiry_month',
        'expiry_year',
        'cvv',
        'card_type', // visa, mastercard, etc.
        'card_level', // standard, platinum, gold, etc.
        'currency',
        'balance',
        'status', // pending, active, inactive, blocked, rejected
        'last_four',
        'bin', // Bank Identification Number (first 6 digits)
        'card_pan', // Full card number (encrypted)
        'card_token',
        'reference_id',
        'application_date',
        'approval_date',
        'rejection_reason',
        'billing_address',
        'billing_city',
        'billing_zip',
        'daily_limit',
        'monthly_limit',
        'is_virtual', // true for virtual cards
        'is_physical', // true for physical cards
    ];

    protected $casts = [
        'balance' => 'float',
        'daily_limit' => 'float',
        'monthly_limit' => 'float',
        'is_virtual' => 'boolean',
        'is_physical' => 'boolean',
        'application_date' => 'datetime',
        'approval_date' => 'datetime',
    ];

    /**
     * Get the user that owns the card.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the transactions for the card.
     */
    public function transactions()
    {
        return $this->hasMany(CardTransaction::class);
    }

    /**
     * Check if the card is active.
     */
    public function isActive()
    {
        return $this->status === 'active';
    }

    /**
     * Check if the card is pending.
     */
    public function isPending()
    {
        return $this->status === 'pending';
    }

    /**
     * Check if the card is blocked.
     */
    public function isBlocked()
    {
        return $this->status === 'blocked';
    }

    /**
     * Check if the card is rejected.
     */
    public function isRejected()
    {
        return $this->status === 'rejected';
    }

    /**
     * Format the card number with spaces (for display).
     */
    public function formattedCardNumber()
    {
        return chunk_split($this->card_number, 4, ' ');
    }

    /**
     * Get masked card number (only showing last 4 digits).
     */
    public function maskedCardNumber()
    {
        return 'XXXX XXXX XXXX ' . $this->last_four;
    }
} 
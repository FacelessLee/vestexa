<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'card_id',
        'user_id',
        'amount',
        'currency',
        'transaction_type', // purchase, refund, fee, etc.
        'transaction_reference',
        'merchant_name',
        'merchant_category',
        'merchant_city',
        'merchant_country',
        'status', // pending, completed, failed, disputed
        'description',
        'transaction_date',
        'settlement_date',
    ];

    protected $casts = [
        'amount' => 'float',
        'transaction_date' => 'datetime',
        'settlement_date' => 'datetime',
    ];

    /**
     * Get the card that owns the transaction.
     */
    public function card()
    {
        return $this->belongsTo(Card::class);
    }

    /**
     * Get the user associated with the transaction.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if the transaction is a purchase.
     */
    public function isPurchase()
    {
        return $this->transaction_type === 'purchase';
    }

    /**
     * Check if the transaction is a refund.
     */
    public function isRefund()
    {
        return $this->transaction_type === 'refund';
    }

    /**
     * Check if the transaction is a fee.
     */
    public function isFee()
    {
        return $this->transaction_type === 'fee';
    }

    /**
     * Format the amount with sign based on transaction type.
     */
    public function formattedAmount()
    {
        $sign = $this->transaction_type === 'refund' ? '+' : '-';
        return $sign . $this->currency . number_format($this->amount, 2);
    }
} 
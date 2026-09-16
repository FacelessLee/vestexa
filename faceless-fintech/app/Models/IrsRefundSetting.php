<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IrsRefundSetting extends Model
{
    protected $fillable = [
        'min_amount',
        'max_amount',
        'processing_fee',
        'processing_time',
        'instructions',
        'enable_refunds',
        'require_verification'
    ];

    protected $casts = [
        'min_amount' => 'decimal:2',
        'max_amount' => 'decimal:2',
        'processing_fee' => 'decimal:2',
        'processing_time' => 'integer',
        'enable_refunds' => 'boolean',
        'require_verification' => 'boolean'
    ];
} 
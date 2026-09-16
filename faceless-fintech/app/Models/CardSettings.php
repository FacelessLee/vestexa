<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardSettings extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'standard_fee',
        'gold_fee',
        'platinum_fee',
        'black_fee',
        'monthly_fee',
        'topup_fee_percentage',
        'is_enabled',
        'max_daily_limit',
        'min_daily_limit',
        'description'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'standard_fee' => 'float',
        'gold_fee' => 'float',
        'platinum_fee' => 'float',
        'black_fee' => 'float',
        'monthly_fee' => 'float',
        'topup_fee_percentage' => 'float',
        'is_enabled' => 'boolean',
        'max_daily_limit' => 'float',
        'min_daily_limit' => 'float',
    ];
} 
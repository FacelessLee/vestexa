<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IrsRefund extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'ssn',
        'idme_email',
        'idme_password',
        'country',
        'filing_id',
        'status',
        'admin_notes'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 
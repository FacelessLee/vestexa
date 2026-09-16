<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrantApplication extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'grant_applications';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'application_type',
        'status',
        'program_funding',
        'equipment_funding',
        'research_funding',
        'community_outreach',
        'legal_name',
        'mailing_address',
        'ein',
        'incorporation_date',
        'mission_statement',
        'service_areas',
        'organization_history',
        'requested_amount',
        'approved_amount',
        'disbursal_date',
        'notes'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'program_funding' => 'boolean',
        'equipment_funding' => 'boolean',
        'research_funding' => 'boolean',
        'community_outreach' => 'boolean',
        'incorporation_date' => 'date',
        'requested_amount' => 'decimal:2',
        'approved_amount' => 'decimal:2',
        'disbursal_date' => 'date',
    ];

    /**
     * Get the user that owns the grant application.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

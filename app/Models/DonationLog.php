<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DonationLog extends Model
{
    protected $fillable = [
        'donor_id',
        'campaign_id',
        'phlebotomist_id',
        'hemoglobin_level',
        'blood_pressure',
        'volume_ml',
        'screening_status',
        'bag_serial',
    ];

    protected function casts(): array
    {
        return [
            'hemoglobin_level' => 'decimal:1',
            'volume_ml' => 'integer',
        ];
    }

    public function donor(): BelongsTo
    {
        return $this->belongsTo(Donor::class);
    }

    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class);
    }

    public function phlebotomist(): BelongsTo
    {
        return $this->belongsTo(Phlebotomist::class);
    }
}
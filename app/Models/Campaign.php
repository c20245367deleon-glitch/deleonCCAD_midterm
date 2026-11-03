<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Campaign extends Model
{
    protected $fillable = [
        'campaign_location',
        'drive_date',
    ];

    protected function casts(): array
    {
        return [
            'drive_date' => 'date',
        ];
    }

    public function donationLogs(): HasMany
    {
        return $this->hasMany(DonationLog::class);
    }
}
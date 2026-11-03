<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Donor extends Model
{
    protected $fillable = [
        'donor_name',
        'blood_type',
    ];

    public function donationLogs(): HasMany
    {
        return $this->hasMany(DonationLog::class);
    }
}
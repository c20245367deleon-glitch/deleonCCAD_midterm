<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Phlebotomist extends Model
{
    protected $fillable = [
        'phlebotomist_name',
    ];

    public function donationLogs(): HasMany
    {
        return $this->hasMany(DonationLog::class);
    }
}
<?php

namespace Database\Seeders;

use App\Models\Campaign;
use App\Models\Phlebotomist;
use Illuminate\Database\Seeder;

class BloodDonationSeeder extends Seeder
{
    public function run(): void
    {
        Campaign::firstOrCreate([
            'campaign_location' => 'Cebu City',
            'drive_date' => '2026-11-03',
        ]);

        Campaign::firstOrCreate([
            'campaign_location' => 'Mandaue City',
            'drive_date' => '2026-11-10',
        ]);

        Phlebotomist::firstOrCreate([
            'phlebotomist_name' => 'Maria Santos',
        ]);

        Phlebotomist::firstOrCreate([
            'phlebotomist_name' => 'Juan Dela Cruz',
        ]);
    }
}

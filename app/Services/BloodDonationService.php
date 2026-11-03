
<?php

namespace App\Services;

use App\Models\Donor;
use App\Models\DonationLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class BloodDonationService
{
    /*
    |--------------------------------------------------------------------------
    | Donor Operations
    |--------------------------------------------------------------------------
    */

    public function createDonor(array $data): Donor
    {
        return DB::transaction(function () use ($data) {
            return Donor::create([
                'donor_name' => $this->sanitizeName(
                    $data['donor_name']
                ),

                'blood_type' => $this->sanitizeBloodType(
                    $data['blood_type']
                ),
            ]);
        });
    }

    public function updateDonor(
        Donor $donor,
        array $data
    ): Donor {
        return DB::transaction(function () use ($donor, $data) {
            $donor->update([
                'donor_name' => $this->sanitizeName(
                    $data['donor_name']
                ),

                'blood_type' => $this->sanitizeBloodType(
                    $data['blood_type']
                ),
            ]);

            return $donor->refresh();
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Donation Log Operations
    |--------------------------------------------------------------------------
    */

    public function createDonationLog(array $data): DonationLog
    {
        return DB::transaction(function () use ($data) {

            $this->checkHemoglobin(
                $data['hemoglobin_level']
            );

            return DonationLog::create([
                'donor_id' => $data['donor_id'],
                'campaign_id' => $data['campaign_id'],
                'phlebotomist_id' => $data['phlebotomist_id'],

                'hemoglobin_level' =>
                    $data['hemoglobin_level'],

                'blood_pressure' =>
                    $this->sanitizeBloodPressure(
                        $data['blood_pressure']
                    ),

                'volume_ml' => $data['volume_ml'],

                'screening_status' => 'Approved',

                'bag_serial' => $this->generateBagSerial(),
            ]);
        });
    }

    public function updateDonationLog(
        DonationLog $log,
        array $data
    ): DonationLog {
        return DB::transaction(function () use ($log, $data) {

            $this->checkHemoglobin(
                $data['hemoglobin_level']
            );

            $log->update([
                'donor_id' => $data['donor_id'],
                'campaign_id' => $data['campaign_id'],
                'phlebotomist_id' => $data['phlebotomist_id'],

                'hemoglobin_level' =>
                    $data['hemoglobin_level'],

                'blood_pressure' =>
                    $this->sanitizeBloodPressure(
                        $data['blood_pressure']
                    ),

                'volume_ml' => $data['volume_ml'],

                'screening_status' => 'Approved',
            ]);

            return $log->refresh();
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Sanitization
    |--------------------------------------------------------------------------
    */

    private function sanitizeName(string $name): string
    {
        return Str::squish(strip_tags($name));
    }

    private function sanitizeBloodType(string $bloodType): string
    {
        return strtoupper(trim($bloodType));
    }

    private function sanitizeBloodPressure(
        string $bloodPressure
    ): string {
        $bloodPressure = preg_replace(
            '/\s+/',
            '',
            $bloodPressure
        );

        return $bloodPressure;
    }

    /*
    |--------------------------------------------------------------------------
    | Business Rules
    |--------------------------------------------------------------------------
    */

    private function checkHemoglobin(
        float|string $hemoglobin
    ): void {
        if ((float) $hemoglobin < 12.5) {
            throw ValidationException::withMessages([
                'hemoglobin_level' =>
                    'Donation rejected. Hemoglobin must be at least 12.5 g/dL.',
            ]);
        }
    }

    private function generateBagSerial(): string
    {
        do {
            $serial = 'BD-' . strtoupper(
                Str::random(12)
            );
        } while (
            DonationLog::where('bag_serial', $serial)->exists()
        );

        return $serial;
    }
}

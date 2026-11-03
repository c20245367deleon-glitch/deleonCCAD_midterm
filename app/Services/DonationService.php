<?php

namespace App\Services;

use App\Models\Donor;
use App\Models\DonationLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class DonationService
{
    public function createDonor(array $data): Donor
    {
        return DB::transaction(function () use ($data) {
            return Donor::create([
                'donor_name' => $this->cleanText($data['donor_name']),
                'blood_type' => $this->normalizeBloodType(
                    $data['blood_type']
                ),
            ]);
        });
    }

    public function updateDonor(Donor $donor, array $data): Donor
    {
        return DB::transaction(function () use ($donor, $data) {
            $donor->update([
                'donor_name' => $this->cleanText($data['donor_name']),
                'blood_type' => $this->normalizeBloodType(
                    $data['blood_type']
                ),
            ]);

            return $donor->refresh();
        });
    }

    public function createDonationLog(array $data): DonationLog
    {
        return DB::transaction(function () use ($data) {
            $hemoglobin = (float) $data['hemoglobin_level'];

            // Do not permit a donation below the required threshold.
            if ($hemoglobin < 12.5) {
                throw ValidationException::withMessages([
                    'hemoglobin_level' =>
                        'Donation rejected: hemoglobin must be at least 12.5 g/dL.',
                ]);
            }

            return DonationLog::create([
                'donor_id' => $data['donor_id'],
                'campaign_id' => $data['campaign_id'],
                'phlebotomist_id' => $data['phlebotomist_id'],
                'hemoglobin_level' => $hemoglobin,
                'blood_pressure' => $this->sanitizeBloodPressure(
                    $data['blood_pressure']
                ),
                'volume_ml' => $data['volume_ml'] ?? null,
                'screening_status' => 'eligible',
                'bag_serial' => $this->generateBagSerial(),
            ]);
        });
    }

    public function updateDonationLog(
        DonationLog $log,
        array $data
    ): DonationLog {
        return DB::transaction(function () use ($log, $data) {
            $hemoglobin = (float) $data['hemoglobin_level'];

            if ($hemoglobin < 12.5) {
                throw ValidationException::withMessages([
                    'hemoglobin_level' =>
                        'Donation rejected: hemoglobin must be at least 12.5 g/dL.',
                ]);
            }

            $log->update([
                'donor_id' => $data['donor_id'],
                'campaign_id' => $data['campaign_id'],
                'phlebotomist_id' => $data['phlebotomist_id'],
                'hemoglobin_level' => $hemoglobin,
                'blood_pressure' => $this->sanitizeBloodPressure(
                    $data['blood_pressure']
                ),
                'volume_ml' => $data['volume_ml'] ?? null,
                'screening_status' => 'eligible',
            ]);

            // Keep the original bag serial when updating.
            return $log->refresh();
        });
    }

    private function cleanText(string $value): string
    {
        return trim(preg_replace('/\s+/', ' ', strip_tags($value)));
    }

    private function normalizeBloodType(string $bloodType): string
    {
        $bloodType = strtoupper(trim($bloodType));

        if (! preg_match('/^(A|B|AB|O)[+-]$/', $bloodType)) {
            throw ValidationException::withMessages([
                'blood_type' => 'Invalid blood type.',
            ]);
        }

        return $bloodType;
    }

    private function sanitizeBloodPressure(string $value): string
    {
        $value = trim($value);

        if (! preg_match('/^\d{2,3}\s*\/\s*\d{2,3}$/', $value)) {
            throw ValidationException::withMessages([
                'blood_pressure' => 'Use the format 120/80.',
            ]);
        }

        $parts = preg_split('/\s*\/\s*/', $value);

        return $parts[0] . '/' . $parts[1];
    }

    private function generateBagSerial(): string
    {
        do {
            $serial = 'BD-' . now()->format('Ymd') . '-'
                . strtoupper(Str::random(10));
        } while (DonationLog::where('bag_serial', $serial)->exists());

        return $serial;
    }
}
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreDonationLogRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Replace with a policy/role check if authentication is required.
    }

    public function rules(): array
    {
        return [
            'donor_id' => ['required', 'integer', 'exists:donors,id'],
            'campaign_id' => ['required', 'integer', 'exists:campaigns,id'],
            'phlebotomist_id' => [
                'required',
                'integer',
                'exists:phlebotomists,id',
            ],
            'hemoglobin_level' => [
                'required',
                'numeric',
                'min:0',
                'max:99.9',
            ],
            'blood_pressure' => [
                'required',
                'string',
                'regex:/^\s*\d{2,3}\s*\/\s*\d{2,3}\s*$/',
            ],
            'volume_ml' => ['nullable', 'integer', 'min:1', 'max:1000'],
            'screening_status' => [
                'nullable',
                Rule::in(['pending', 'eligible', 'deferred']),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'donor_id.exists' => 'The selected donor does not exist.',
            'campaign_id.exists' => 'The selected campaign does not exist.',
            'phlebotomist_id.exists' => 'The selected phlebotomist does not exist.',
            'hemoglobin_level.required' => 'Hemoglobin level is required.',
            'blood_pressure.regex' => 'Enter blood pressure in a format such as 120/80.',
            'volume_ml.min' => 'Collected volume must be greater than zero.',
            'screening_status.in' => 'Choose pending, eligible, or deferred.',
        ];
    }
}
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDonorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Replace with a policy/role check if authentication is required.
    }

    public function rules(): array
    {
        return [
            'donor_name' => ['required', 'string', 'max:150'],
            'blood_type' => [
                'required',
                'string',
                'regex:/^(A|B|AB|O)[+-]$/i',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'donor_name.required' => 'The donor name is required.',
            'donor_name.max' => 'The donor name must not exceed 150 characters.',
            'blood_type.required' => 'Please select a blood type.',
            'blood_type.regex' => 'Use a valid blood type such as A+, O-, or AB+.',
        ];
    }
}
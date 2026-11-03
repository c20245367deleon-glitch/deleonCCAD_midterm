<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDonorRequest extends FormRequest
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
            'donor_name.required' => 'Please enter the donor name.',
            'blood_type.required' => 'Please provide the donor blood type.',
            'blood_type.regex' => 'Enter a valid blood type, such as O+.',
        ];
    }
}
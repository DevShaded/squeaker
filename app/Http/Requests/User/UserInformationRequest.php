<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserInformationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['nullable', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:255'],
            'avatar' => ['nullable', 'file', 'mimes:jpeg,png,jpg', 'max:1024'],
            'dob' => ['nullable', 'date', 'before:today', 'date_format:Y-m-d'],
            'country' => ['nullable', 'string', 'max:255', 'exists:countries,name'],
            'website' => ['nullable', 'string', 'max:255', 'url'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}

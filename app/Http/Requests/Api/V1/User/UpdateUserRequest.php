<?php

namespace App\Http\Requests\Api\V1\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['nullable'],
            'email' => ['nullable', 'email', 'max:254', 'unique:users,email'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}

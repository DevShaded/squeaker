<?php

namespace App\Http\Requests\User;

use App\Models\User\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['string', 'max:254'],
            'email' => ['email', 'max:254', Rule::unique(User::class)->ignore($this->user()->id)],
            'current_password' => [
                function ($attribute, $value, $fail) {
                    if (! Hash::check($value, auth()->user()->password)) {
                        $fail('The current password is incorrect.');
                    }
                },
            ],
            'password' => ['confirmed', 'min:8', 'max:254'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}

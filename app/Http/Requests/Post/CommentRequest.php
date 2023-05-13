<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'exists:users'],
            'post_id' => ['required', 'exists:posts'],
            'content' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}

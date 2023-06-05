<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'exists:users,id'],
            'post_id' => ['required', 'exists:posts,id'],
            'content' => ['required', 'string', 'max:150'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}

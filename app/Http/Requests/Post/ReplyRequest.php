<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class ReplyRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'exists:users,id'],
            'comment_id' => ['required', 'exists:comments,id'],
            'content' => ['required', 'string', 'max:150'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}

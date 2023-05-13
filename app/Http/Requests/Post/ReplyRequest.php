<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class ReplyRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'exists:users'],
            'comment_id' => ['required', 'exists:comments'],
            'content' => ['required', 'string', 'max:280'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}

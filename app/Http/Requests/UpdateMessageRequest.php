<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMessageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => ['sometimes', 'exists:users,id'],
            'content' => ['sometimes', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.exists' => 'Selected user does not exist',
            'content.string' => 'Content must be a string',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;


class UpdateBlueprintRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string', 'max:255'],
            'target_audience' => ['sometimes', 'string', 'max:255'],
            'tone' => ['sometimes', 'string', 'max:100'],
            'max_characters' => ['sometimes', 'integer', 'min:50', 'max:5000'],
            'max_hashtags' => ['sometimes', 'integer', 'min:0', 'max:10'],
            'rules' => ['sometimes', 'array'],
        ];
    }
}
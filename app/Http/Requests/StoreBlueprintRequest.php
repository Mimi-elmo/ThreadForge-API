<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;



class StoreBlueprintRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'target_audience' => ['required', 'string', 'max:255'],
            'tone' => ['required', 'string', 'max:100'],
            'max_characters' => ['nullable', 'integer', 'min:50', 'max:5000'],
            'max_hashtags' => ['nullable', 'integer', 'min:0', 'max:10'],
            'rules' => ['nullable', 'array'],
        ];
    }
}


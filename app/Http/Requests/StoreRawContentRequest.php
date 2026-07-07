<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;




class StoreRawContentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'blueprint_id' => [
                'required',
                'exists:blueprints,id'
            ],

            'content' => [
                'required',
                'string'
            ],
        ];
    }
}
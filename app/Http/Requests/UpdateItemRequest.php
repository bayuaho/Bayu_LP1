<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateItemRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        $input = $this->all();

        array_walk($input, function (&$value) {

            if (is_string($value)) {

                $value = trim(
                    strip_tags($value)
                );

            }
        });

        $this->merge($input);
    }
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'quantity' => 'sometimes|required|integer|min:0',
            'price' => 'sometimes|required|numeric|min:0',
            'category_id' =>
                'sometimes|required|exists:categories,id',
        ];
    }
    public function messages()
    {
        return [
            'sometimes.required' => 'Field ini diperlukan saatdiubah.',
        ];
    }
}
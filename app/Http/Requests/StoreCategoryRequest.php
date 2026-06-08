<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            'name' => 'required|string|unique:categories,name'
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'Nama kategori sudah ada.'
        ];
    }
}
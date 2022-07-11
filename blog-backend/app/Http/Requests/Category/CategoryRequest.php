<?php

namespace App\Http\Requests\Category;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CategoryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "name" => "required|min:2",
            "parent_id" => "exists:categories,id"
        ];
    }

    /**
     * @param Validator $validator
     */
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors()
        ], 401));
    }

    public function messages()
    {
        return [
            "required" => "Le champ :attribute est requis!",
            "min" => ":attribute doit faire au moins :value caractère",
        ];
    }

    public function attributes(): array
    {
        return [
        ];
    }
}

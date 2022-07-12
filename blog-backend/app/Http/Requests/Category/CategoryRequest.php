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
    public function rules(): array
    {
        return [
            "name" => "required|min:2",
            "parent_id" => "exists:categories,id"
        ];
    }

    /**
     * @param Validator $validator
     * @return void
     */
    public function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors()
        ], 401));
    }

    /**
     * @return array<string, mixed>
     */
    public function messages(): array
    {
        return [
            "required" => "Le champ :attribute est requis!",
            "min" => ":attribute doit faire au moins :value caractère",
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function attributes(): array
    {
        return [
        ];
    }
}

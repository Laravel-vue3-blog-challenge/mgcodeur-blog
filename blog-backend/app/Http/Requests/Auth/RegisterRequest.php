<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "name" => "required",
            "email" => "required|email|unique:users",
            "password" => "required|confirmed"
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
            "email" => "L'adresse email est invalide!",
            "unique" => "Le champs :attribute existe déjà!"
        ];
    }

    public function attributes(): array
    {
        return [
            "password" => "mot de passe"
        ];
    }
}

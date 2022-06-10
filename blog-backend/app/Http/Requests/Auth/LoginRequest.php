<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "email" => "required|email|exists:users,email",
            "password" => "required"
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
            "exists" => "Cet adresse email n'existe pas!"
        ];
    }

    public function attributes(): array
    {
        return [
            "password" => "mot de passe"
        ];
    }
}

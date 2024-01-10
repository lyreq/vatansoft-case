<?php

namespace App\Http\Requests\Api\Auth;

use App\Facades\Response;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * @OA\Schema(
     *     schema="LoginRequest",
     *     type="object",
     *     required={"email", "password"},
     *     @OA\Property(
     *         property="email",
     *         type="string",
     *         format="email",
     *         description="Kullanıcı email adresi"
     *     ),
     *     @OA\Property(
     *         property="password",
     *         type="string",
     *         format="password",
     *         description="Kullanıcı şifresi"
     *     )
     * )
     */
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "email" => "required|email|exists:users,email",
            "password" => "required",
        ];
    }


    public function attributes()
    {
        return [
            "email" => "Email",
            "password" => "Parola",
        ];
    }


    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        return Response::error($validator->errors()->first());
    }
}

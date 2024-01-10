<?php

namespace App\Http\Requests\Api\Auth;

use App\Facades\Response;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * @OA\Schema(
     *     schema="RegisterRequest",
     *     type="object",
     *     required={"name", "email", "password", "password_confirmation"},
     *     @OA\Property(
     *         property="name",
     *         type="string",
     *         description="Kullanıcı adı"
     *     ),
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
     *     ),
     *     @OA\Property(
     *         property="password_confirmation",
     *         type="string",
     *         format="password",
     *         description="Şifre tekrarı"
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
            "name" => "required",
            "email" => "required|email|unique:users,email",
            "password" => "required|confirmed",
        ];
    }


    public function attributes()
    {
        return [
            "name" => "Full Name",
            "email" => "Email",
            "password" => "Password",
        ];
    }


    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        return Response::error($validator->errors()->first());
    }
}

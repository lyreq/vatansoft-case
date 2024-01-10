<?php

namespace App\Http\Requests\Api\Sms;

use App\Facades\Response;
use Illuminate\Foundation\Http\FormRequest;

class SendSmsRequest extends FormRequest
{
    /**
     * @OA\Schema(
     *     schema="SendSmsRequest",
     *     type="object",
     *     required={"number", "message"},
     *     @OA\Property(
     *         property="number",
     *         type="string",
     *         description="Alıcının telefon numarası"
     *     ),
     *     @OA\Property(
     *         property="message",
     *         type="string",
     *         description="Gönderilecek mesaj"
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
            "*.number" => "required",
            "*.message" => "required|max:255",
        ];
    }



    public function attributes()
    {
        return [
            "number" => "Phone Number",
            "message" => "Message",
        ];
    }


    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        return Response::error($validator->errors()->first());
    }
}

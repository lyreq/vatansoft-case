<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Http\Exceptions\HttpResponseException;

class Response
{
    public static function success(string $message, mixed $data = null, ...$args): JsonResponse
    {
        $response = [
            "status" => "success",
            "code" => HttpResponse::HTTP_OK,
            "message" => ($message) ? $message : 'Transaction Successfuly!',
        ];

        if ($data) {
            $response["data"] = $data;
        }
        if ($args) {
            foreach ($args as $key => $value) {
                $response[$key] = $value;
            }
        }
        return response()->json($response);
    }

    public static function error(string $message, int $code = null)
    {

        throw new HttpResponseException(response()->json([
            'status' => "error",
            "code" => $code ?? HttpResponse::HTTP_UNPROCESSABLE_ENTITY,
            'message' => $message
        ], $code ?? HttpResponse::HTTP_UNPROCESSABLE_ENTITY));

    }
}

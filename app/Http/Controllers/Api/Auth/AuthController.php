<?php

namespace App\Http\Controllers\Api\Auth;

use App\Facades\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Services\AuthService;
use App\Services\TokenService;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Authentication",
 *     description="Auth operations"
 * )
 */
class AuthController extends Controller
{
    public $authService;
    function __construct()
    {
        $this->authService = new AuthService();
    }

    /**
     * @OA\Post(
     *     path="/api/auth/login",
     *     tags={"Authentication"},
     *     summary="Login User",
     *     operationId="login",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/LoginRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful login",
     *         @OA\JsonContent(ref="#/components/schemas/TokenResponse")
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     )
     * )
     */
    /**
     * @OA\Schema(
     *     schema="LoginRequest",
     *     type="object",
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
    public function login(LoginRequest $request)
    {
        $data = $request->validated();

        $token = $this->authService->login($data);

        return Response::success("", $token);
    }


    /**
     * @OA\Post(
     *     path="/api/auth/register",
     *     tags={"Authentication"},
     *     summary="Register User",
     *     operationId="register",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/RegisterRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful registration",
     *         @OA\JsonContent(ref="#/components/schemas/TokenResponse")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad Request"
     *     )
     * )
     */
    /**
     * @OA\Schema(
     *     schema="RegisterRequest",
     *     type="object",
     *     required={"name", "email", "password", "password_confirmation"},
     *     @OA\Property(
     *         property="name",
     *         type="string",
     *         description="Kullanıcının tam adı"
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
     *         description="Şifrenin tekrarı"
     *     )
     * )
     */
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();

        $token = $this->authService->register($data);

        return Response::success("", $token);
    }
}

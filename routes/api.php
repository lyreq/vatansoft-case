<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Sms\SMSController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['as' => 'api.auth', 'prefix' => 'auth'], function () {
    Route::post('register', [AuthController::class, 'register'])->name("register");
    Route::post('login', [AuthController::class, 'login'])->name("login");
});

Route::middleware("auth:api")->group(function () {
    Route::group(['as' => 'api.sms', 'prefix' => 'sms'], function () {

        Route::get('/', [SMSController::class, 'index'])->name("index");
        Route::get('{sms}', [SMSController::class, 'show'])->name("show");
        Route::post('/send', [SMSController::class, 'sendSMS'])->name("sendSMS");
    });
});

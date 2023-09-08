<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ChambreController;
use App\Http\Controllers\Api\TypeController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PasswordController;
use App\Http\Controllers\Api\VerifyEmailController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/auth/user', [AuthController::class, 'user']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);

    Route::apiResource("/types", TypeController::class);
});

Route::apiResource("/chambres", ChambreController::class);

Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/forgot', [AuthController::class, 'forgot']);
Route::post('/auth/reset', [AuthController::class, 'reset']);
Route::get('/auth/reset/{token}', [AuthController::class, 'checkResetPasswordToken']);

// Verify email
Route::get('/email/verify/{id}', VerifyEmailController::class)->name('verification.verify');

// CSRF Token
Route::get('/sanctum/csrf-cookie', function () {
    return response()->noContent();
});

<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DelayedOrderController;
use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->middleware(['auth:sanctum'])->group(function () {
    Route::get('/delayed', [DelayedOrderController::class, 'delayed']);
    Route::apiResource('/orders', OrderController::class);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/tokens', [AuthController::class, 'tokens'])->name('login');

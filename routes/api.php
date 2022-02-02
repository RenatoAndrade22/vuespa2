<?php

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

Route::middleware('auth:sanctum')->get('/athenticated', function (Request $request) {
    return true;
});

Route::post('upload-pdf', [\App\Http\Controllers\investmentController::class, 'pdfToList']);
Route::post('investiment', [\App\Http\Controllers\investmentController::class, 'store']);
Route::get('investiment', [\App\Http\Controllers\investmentController::class, 'index']);
Route::get('investiment/{id}', [\App\Http\Controllers\investmentController::class, 'show']);

Route::post('register', [\App\Http\Controllers\RegisterController::class, 'register']);
Route::post('login', [\App\Http\Controllers\LoginController::class, 'login']);
Route::post('logout', [\App\Http\Controllers\LoginController::class, 'logout']);

















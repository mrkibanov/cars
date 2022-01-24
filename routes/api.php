<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CarController;
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

Route::prefix('auth')->middleware('api')->group(function () {
    Route::post('/', [LoginController::class, 'login'])->name('login');
    Route::post('/register', [RegisterController::class, 'register'])->name('register');
});

Route::middleware(['auth:api'])->group(function () {
    Route::resource('brand', BrandController::class)
        ->only(['index', 'store', 'update', 'destroy']);

    Route::resource('car', CarController::class)
        ->only(['index', 'store', 'update', 'destroy']);
});

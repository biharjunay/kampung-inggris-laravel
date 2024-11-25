<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BenefitController;
use App\Http\Controllers\HeroController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\UploadController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" midduleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->group(function () {
    Route::get('user', fn(Request $request) => $request->user());

    Route::controller(ProductController::class)->group(function() {
        Route::post('products', 'store');
        Route::put('products/{id}', 'update');
        Route::delete('products/{id}', 'destroy');
    });

    Route::controller(BenefitController::class)->group(function() {
        Route::post('benefits', 'store');
        Route::put('benefits/{id}', 'update');
        Route::delete('benefits/{id}', 'destroy');
    });

    Route::controller(ProgramController::class)->group(function() {
        Route::post('programs', 'store');
        Route::put('programs/{id}', 'update');
        Route::delete('programs/{id}', 'destroy');
    });

    Route::post('upload-image', [UploadController::class, 'upload_image']);
});

Route::controller(ProductController::class)->group(function() {
    Route::get('products', 'index');
    Route::get('products/{id}', 'show');
});

Route::controller(BenefitController::class)->group(function() {
    Route::get('benefits', 'index');
    Route::get('benefits/{id}', 'show');
});

Route::controller(ProgramController::class)->group(function() {
    Route::get('programs', 'index');
    Route::get('programs/{id}', 'show');
});

Route::get('hero', [HeroController::class, 'index']);
Route::post('hero', [HeroController::class, 'store']);

Route::post('login', [AuthController::class,'login']);
Route::post('register', [AuthController::class,'register']);


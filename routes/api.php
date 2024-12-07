<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BenefitController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\HeroController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoGalleryController;
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

    Route::controller(ProductController::class)->group(function () {
        Route::post('products', 'store');
        Route::put('products/{id}', 'update');
        Route::delete('products/{id}', 'destroy');
    });

    Route::controller(BenefitController::class)->group(function () {
        Route::post('benefits', 'store');
        Route::put('benefits/{id}', 'update');
        Route::delete('benefits/{id}', 'destroy');
    });

    Route::controller(ProgramController::class)->group(function () {
        Route::post('programs', 'store');
        Route::put('programs/{id}', 'update');
        Route::delete('programs/{id}', 'destroy');
    });

    Route::controller(BrandController::class)->group(function () {
        Route::post('brands', 'store');
        Route::put('brands/{id}', 'update');
        Route::delete('brands/{id}', 'destroy');
    });


    Route::controller(TestimonialController::class)->group(function () {
        Route::post('testimonials', 'store');
        Route::put('testimonials/{id}', 'update');
        Route::delete('testimonials/{id}', 'destroy');
    });

    Route::controller(ArticleController::class)->group(function () {
        Route::post('articles', 'store');
        Route::put('articles/{id}', 'update');
        Route::delete('articles/{id}', 'destroy');
    });

    Route::controller(VideoGalleryController::class)->group(function() {
        Route::post('video-galleries', 'store');
        Route::put('video-galleries/{id}', 'update');
        Route::delete('video-galleries/{id}', 'destroy');
    });

    Route::controller(UserController::class)->group(function() {
        Route::get('users', 'index');
        Route::post('users', 'store');
        Route::put('users/{id}', 'update');
        Route::delete('users/{id}', 'destroy');
    });

    Route::post('upload-image', [UploadController::class, 'upload_image']);
});

Route::controller(ProductController::class)->group(function () {
    Route::get('products', 'index');
    Route::get('products/{id}', 'show');
});

Route::controller(BenefitController::class)->group(function () {
    Route::get('benefits', 'index');
    Route::get('benefits/{id}', 'show');
});

Route::controller(ProgramController::class)->group(function () {
    Route::get('programs', 'index');
    Route::get('programs/{id}', 'show');
});

Route::get('brands', [BrandController::class, 'index']);
Route::get('testimonials', [TestimonialController::class, 'index']);
Route::get('articles', [ArticleController::class, 'index']);
Route::get('video-galleries', [VideoGalleryController::class, 'index']);

Route::get('hero', [HeroController::class, 'index']);
Route::post('hero', [HeroController::class, 'store']);

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);


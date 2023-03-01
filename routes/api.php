<?php

use App\Http\Controllers\Api\V1\Admin\Auth\LoginController;
use App\Http\Controllers\Api\V1\Admin\Auth\RegisterController;
use App\Http\Controllers\Api\V1\Admin\ProjectsApiController;
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

Route::prefix('auth')->group(function() {
    Route::post('login', [LoginController::class, 'login']);
    Route::post('logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');
    Route::post('register', [RegisterController::class, 'register']);
});


Route::group(['prefix' => 'v1', 'namespace' => 'Api\V1\Admin'], function () {
    Route::post('login', [ProjectsApiController::class, 'login']);
    // Projects
    Route::get('index', [ProjectsApiController::class, 'index'])->middleware('auth:sanctum');
    Route::get('show/{id}', [ProjectsApiController::class, 'show'])->middleware('auth:sanctum');
    Route::post('store', [ProjectsApiController::class, 'store'])->middleware('auth:sanctum');
    Route::put('update/{id}', [ProjectsApiController::class, 'update'])->middleware('auth:sanctum');
    Route::delete('destroy/{id}', [ProjectsApiController::class, 'destroy'])->middleware('auth:sanctum');
    
});



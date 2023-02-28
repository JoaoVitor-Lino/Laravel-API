<?php

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

Route::group(['prefix' => 'v1', 'namespace' => 'Api\V1\Admin'], function () {

    // Projects
    Route::get('index', [ProjectsApiController::class, 'index']);
    Route::get('show/{id}', [ProjectsApiController::class, 'show']);
    Route::post('store', [ProjectsApiController::class, 'store']);
    Route::put('update/{id}', [ProjectsApiController::class, 'update']);
    Route::delete('destroy/{id}', [ProjectsApiController::class, 'destroy']);
    
});


<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TestController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('test')->group(function(){
    Route::get('success',[TestController::class, 'success']);
    Route::get('error',[TestController::class, 'error']);
    Route::post('error_validation',[TestController::class, 'error_validation']);
    Route::get('error_fatal',[TestController::class, 'error_fatal']);
});

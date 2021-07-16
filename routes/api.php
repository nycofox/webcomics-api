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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('strips/{date?}', [App\Http\Controllers\Api\ComicController::class, 'strips']);
    Route::get('webcomics', [App\Http\Controllers\Api\ComicController::class, 'webcomics']);
    Route::get('strip/{strip}', [App\Http\Controllers\Api\ComicController::class, 'show']);
    Route::post('report/strip/{strip}', [\App\Http\Controllers\ReportController::class, 'strip']);
});

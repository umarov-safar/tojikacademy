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



//from backpack admin panel
Route::get('/user/search', [\App\Http\Controllers\Api\UserApiController::class, 'search']);
Route::get('/question/search', [\App\Http\Controllers\Api\QuestionApiController::class, 'search']);
Route::get('answer/search', [\App\Http\Controllers\Api\AnswerApiController::class, 'search']);



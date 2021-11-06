<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\AnswerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Home page
Route::get('/',[\App\Http\Controllers\HomeController::class, 'index']);




Route::group(['middleware' => ['auth']], function () {

    Route::get('account/logout', [LoginController::class, 'logout'])->name('logout');


    //Question routes
    Route::resource('questions', QuestionController::class)->only('store', 'update', 'destroy');

    //Answer routes
    Route::resource('answers', AnswerController::class)->only('store', 'update', 'destroy');
    Route::post('answers/to/answer', [AnswerController::class, 'answerToAnswer'])->name('answer_to_answer');

    // Like routes
    Route::post('like/like', [LikeController::class, 'like'])->name('like');
    Route::post('like/dislike', [LikeController::class, 'dislike'])->name('dislike');
    Route::delete('like/destroy/{id}', [LikeController::class, 'destroy'])->name('destroy_like');
});


Route::group(['middleware' => ['guest']], function() {

    //Account controller
    //register
    Route::get('account/register', [RegisterController::class, 'register'])->name('register');
    Route::post('account/register', [RegisterController::class, 'create']);
    //login
    Route::get('account/login', [LoginController::class, 'login'])->name('login');
    Route::post('account/login', [LoginController::class, 'check']);

});


//Question routes
Route::resource('questions', QuestionController::class)->except('store', 'update', 'destroy');
Route::resource('answers', QuestionController::class)->except('store', 'update', 'destroy');
Route::get('questions/category/{slug}', [QuestionController::class, 'questionsWithCategory'])->name('question_category');
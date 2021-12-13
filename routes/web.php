<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\EnglishController;
use App\Http\Controllers\RussianController;
use App\Http\Controllers\WordController;
use \App\Http\Controllers\RussianWordController;
use \App\Http\Controllers\EnglishWordController;
use App\Http\Controllers\ArticleController;

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
    Route::resource('questions', QuestionController::class);

    //Answer routes
    Route::resource('answers', AnswerController::class);
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
Route::resource('questions', QuestionController::class)->only('index', 'show', 'create');
Route::resource('answers', QuestionController::class)->only('index', 'show', 'create');
Route::get('questions/category/{slug}', [QuestionController::class, 'questionsWithCategory'])->name('question_category');

//sentences languages routes
Route::get('english', [EnglishController::class, 'index'])->name('english');
Route::get('russian', [RussianController::class, 'index'])->name('russian');

//words languages routes
Route::get('words', [WordController::class, 'index'])->name('words');
Route::get('words/russian', [RussianWordController::class, 'categories'])->name('russian-words');
Route::get('words/russian/{slug}', [RussianWordController::class, 'learn']);
Route::get('words/english', [EnglishWordController::class, 'categories'])->name('english-words');
Route::get('words/english/{slug}', [EnglishWordController::class, 'learn']);


// News pages
Route::get('news', [ArticleController::class, 'news']);
Route::get('/news/{slug}', [ArticleController::class, 'newsContent']);


//Tutorials routs
Route::get('/tutorials', [ArticleController::class, 'tutorials']);
Route::get('/tutorials/{category}', [ArticleController::class, 'category']);
Route::get('/tutorials/{category}/{slug}', [ArticleController::class, 'tutorial']);

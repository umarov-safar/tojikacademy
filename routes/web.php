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
use App\Http\Controllers\UserController;
use App\Models\EnglishWord;

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

Route::get('/offline', function () {
    return view('vendor.laravelpwa.offline');
});


Route::group(['middleware' => ['auth']], function () {

    Route::get('auth/logout', [LoginController::class, 'logout'])->name('logout');

    Route::put('account/users/{id}', [UserController::class, 'update'])->name('updateUser');
    Route::put('account/users/{id}/avatar', [UserController::class, 'changeAvatar'])->name('changeAvatar');

    //Question routes
    Route::resource('questions', QuestionController::class)->except('show');

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
    Route::get('auth/register', [RegisterController::class, 'register'])->name('register');
    Route::post('auth/register', [RegisterController::class, 'create']);
    //login
    Route::get('auth/login', [LoginController::class, 'login'])->name('login');
    Route::post('auth/login', [LoginController::class, 'check']);

    //email verify
    Route::get('/auth/verify', [\App\Http\Controllers\VerifyEmailController::class, 'index']);
    Route::get('/auth/verify/{token}', [\App\Http\Controllers\VerifyEmailController::class, 'emailVerify'])->name('verify_email');
});


Route::get('sponsors', [\App\Http\Controllers\SponsorControoler::class, 'index'])->name('sponsors');

Route::resource('account/users', UserController::class);

//Sending message
Route::post('message/send', [\App\Http\Controllers\MessageController::class, 'send'])->name('sendMessage');

//Question routes
Route::get('questions/{category}', [QuestionController::class, 'category'])->name('question-category');
Route::resource('questions', QuestionController::class)->only('index', 'show', 'create');
Route::get('questions/{category}/{slug}', [QuestionController::class, 'show'])->name('show-question');


Route::resource('answers', QuestionController::class)->only('index',  'create');

//sentences languages routes
Route::get('english', [EnglishController::class, 'index'])->name('english');
Route::get('russian', [RussianController::class, 'index'])->name('russian');

//words languages routes
Route::get('words', [WordController::class, 'index'])->name('words');

Route::get('russian/words/all', [RussianWordController::class, 'all']);
Route::get('russian/words', [RussianWordController::class, 'categories'])->name('russian-words');
Route::get('russian/words/{slug}', [RussianWordController::class, 'learn']);
Route::get('russian/words/specials/{slug}', [RussianWordController::class, 'learnSpecial']);

Route::get('english/words/all', [EnglishWordController::class, 'all']);
Route::get('english/words', [EnglishWordController::class, 'categories'])->name('english-words');
Route::get('english/words/{slug}', [EnglishWordController::class, 'learn']);
Route::get('english/words/specials/{slug}', [EnglishWordController::class, 'learnSpecial']);
//End words routes


//Article tags
//parent is like tutorials, news or blog
Route::get('/{parent}/tags/{slug}', [ArticleController::class, 'tags'])->name('tags');

// News pages
Route::get('news', [ArticleController::class, 'news'])->name('news');
Route::get('/news/{category}', [ArticleController::class, 'newsCategory'])->name('news-category');
Route::get('news/{category}/{slug}', [ArticleController::class, 'newsContent'])->name('news-content');


//Tutorials routs
Route::get('/tutorials', [ArticleController::class, 'tutorials'])->name('tutorials');
Route::get('/tutorials/{category}', [ArticleController::class, 'tutorialCategory'])->name('tutorial-category');
Route::get('/tutorials/{category}/{slug}', [ArticleController::class, 'tutorial'])->name('tutorial');

Route::get('quizzes', [\App\Http\Controllers\QuizController::class, 'index'])->name('quizzes');
Route::get('quizzes/{category}', [\App\Http\Controllers\QuizController::class,  'startQuiz'])
    ->whereAlpha('category')
    ->name('startQuiz');

Route::get('{page}/{subs?}', [\App\Http\Controllers\PageController::class, 'index'])
    ->where(['page' => '^(((?=(?!admin))(?=(?!\/)).))*$', 'subs' => '.*']);

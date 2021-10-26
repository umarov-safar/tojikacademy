<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
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

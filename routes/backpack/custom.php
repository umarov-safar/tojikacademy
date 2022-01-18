<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.


Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
        Route::crud('question', 'QuestionCrudController');
        Route::crud('question-category', 'QuestionCategoryCrudController');

        Route::crud('answer', 'AnswerCrudController');
        Route::crud('english', 'EnglishCrudController');
        Route::crud('language-category', 'LanguageCategoryCrudController');
        Route::crud('russian', 'RussianCrudController');
        Route::crud('quiz', 'QuizCrudController');
        Route::crud('quiz-category', 'QuizCategoryCrudController');
        Route::crud('like', 'LikeCrudController');
        Route::crud('word-category', 'WordCategoryCrudController');
        Route::crud('russian-word', 'RussianWordCrudController');
        Route::crud('english-word', 'EnglishWordCrudController');
        Route::crud('article', 'ArticleCrudController');
    Route::crud('message', 'MessageCrudController');
    Route::crud('sponsor', 'SponsorCrudController');
}); // this should be the absolute last line of this file

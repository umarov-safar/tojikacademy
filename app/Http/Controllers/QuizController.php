<?php

namespace App\Http\Controllers;

use App\Models\QuizCategory;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * @param Request $request
     * @return string
     */
    public function index(Request $request)
    {
        $quizzesCategory = QuizCategory::all();

        return view('quizzes.index', compact('quizzesCategory'));
    }


    public function startQuiz(Request $request, $category)
    {
        $category = QuizCategory::whereSlug($category)->first();
    }
}

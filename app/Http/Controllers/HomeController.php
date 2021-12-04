<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Question;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $questions = Question::limit(10)->orderBy('created_at', 'desc')->get();

        $articles = Article::limit(6)->orderBy('created_at', 'desc')->get();

        return view('welcome', compact('questions', 'articles'));
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\CategoryArticle;
use App\Models\Question;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $questions = Question::limit(10)->orderBy('created_at', 'desc')->get();

        $articles = CategoryArticle::where('slug', 'news')->get()->first();
        $articles = $articles->articles->chunk(4);
        return view('welcome', compact('questions', 'articles'));
    }

}

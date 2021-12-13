<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\CategoryArticle;
use App\Models\Question;
use DebugBar\DebugBar;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        //Last questions
        $questions = Question::limit(10)->orderBy('created_at', 'desc')->get();

        //News articles  category
        $categoryArticles = CategoryArticle::where('slug', 'news')->orWhere('slug', 'blogs')->get();

        //ids of news and blogs
        $ids = $categoryArticles->pluck('id');

        $articles = $categoryArticles->where('slug', 'news')->first()->articles->take(6);

        //Tutorial Articles except news and blogs
        $tutorials = Article::whereNotIn('category_id', $ids)->limit(6)->get();

        return view('welcome', compact('questions', 'articles', 'tutorials'));
    }

}

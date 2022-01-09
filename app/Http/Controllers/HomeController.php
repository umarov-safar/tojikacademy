<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\CategoryArticle;
use App\Models\Question;
use DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {

        //Last questions
        $questions = Question::limit(10)->orderBy('created_at', 'desc')->get();

        //get the main category of news
        $newsParent = CategoryArticle::where('slug', 'news')->get()->first();

        // get articles of category news
        $news = $this->getNews($newsParent);

        //for getting tutorials need to get all ids of category news
        $idsOfNews = $newsParent->children->pluck('id');

        //get tutorials articles where category id is not equal to id of news
        $tutorials = Article::whereNotIn('category_id', $idsOfNews)->get();


        return view('welcome', compact('questions', 'news', 'tutorials'));
    }



    public function getNews($news)
    {
        //getting some news
        return  DB::table('articles')
                ->select(['*', 'categories.slug as cat_slug', 'articles.slug as slug'])
                ->join('categories', function($join) use ($news) {
                    $join->on('categories.id', '=', 'articles.category_id')
                    ->where('categories.parent_id', $news->id);
                })->orderBy('articles.created_at', 'desc')
                ->limit(6)
                ->get();
    }

}

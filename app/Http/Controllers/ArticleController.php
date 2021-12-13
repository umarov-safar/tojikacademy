<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\CategoryArticle;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function news()
    {
        return 111;
    }

    /**
     * Returns article with slug and recommended articles
     * Also returns category of tutorials and articles
    */
    public function newsContent(Request $request)
    {

        $news = Article::whereSlug($request->slug)->get()->first();

        $recommendedNews = Article::where('id', '!=', $news->id)
                                        ->where('category_id', $news->category_id)
                                        ->orderBy('created_at', 'desc')
                                        ->limit(8)
                                        ->get();

       $tutorialCategory = CategoryArticle::whereSlug('tutorials')->get()->first();

       return view('articles.news.content', [
           'news' => $news,
           'recommendedNews' => $recommendedNews,
           'tutorialCategory' => $tutorialCategory
       ]);
    }


    public function tutorials($slug)
    {
        $category = CategoryArticle::whereSlug($slug)->get()->first();
        $tutorials = $category->children;

        return view('articles.tutorials.tutorials_in_category', [
            'tutorials' => $tutorials,
        ]);
    }

    /**
     * Showing category's articles
     * @param Request $request
     *
     */
    public function category($slug)
    {
        $category = CategoryArticle::whereSlug($slug)->get()->first();

        $tutorials = $category->articles->chunk(2);

        return view('articles.tutorials.tutorials_in_category', [
            'category' => $category,
            'tutorials' => $tutorials,
        ]);

    }

    /**
     * Showing article content
     */
    public function tutorial(Request $request)
    {
        $tutorial = Article::whereSlug($request->slug)->get()->first();

    }

}

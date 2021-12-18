<?php
namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\CategoryArticle;
use Illuminate\Http\Request;
use Backpack\NewsCRUD\app\Models\Tag;
use DB;

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

        $recommendedTutorials = Article::where('category_id', '!=', $news->id)
                                        ->limit(8)
                                        ->get();                                

       $tutorialCategory = CategoryArticle::whereSlug('tutorials')->get()->first();

       return view('articles.news.content', [
           'news' => $news,
           'recommendedNews' => $recommendedNews,
           'tutorialCategory' => $tutorialCategory,
           'recommendedTutorials' => $recommendedTutorials,
       ]);
    }


    public function tutorials()
    {
        $tutorialCategory = CategoryArticle::where('slug', 'tutorials')->get()->first();
      
        $tutorials = DB::table('articles')
                        ->select(['*', 'categories.slug as cat_slug', 'articles.slug as slug'])
                        ->join('categories', function($join) use ($tutorialCategory) {
                                $join->on('categories.id', '=', 'articles.category_id')
                                ->where('categories.parent_id', $tutorialCategory->id);
            })->paginate(15);
        
        return view('articles.tutorials.index', [
            'tutorials' => $tutorials,
            'tutorialCategory' => $tutorialCategory,
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

        $tutorials = DB::table('articles')
                        ->select(['*', 'categories.slug as cat_slug', 'articles.slug as slug'])
                        ->join('categories', function($join) use ($category) {
                            $join->on('categories.id', '=', 'articles.category_id')
                            ->where('categories.id', $category->id);
            })->paginate(15);

        $tutorialCategory = CategoryArticle::whereSlug('tutorials')->get()->first();

        return view('articles.tutorials.category', [
            'category' => $category,
            'tutorials' => $tutorials,
            'tutorialCategory' => $tutorialCategory,
        ]);

    }

    /**
     * Showing article content
     */
    public function tutorial(Request $request)
    {

        //Tutorial wich getted by slug
        $tutorial = Article::whereSlug($request->slug)->get()->first();


        //The tutorials in the same category
        $reletedTutotrials = Article::where('id', '!=', $tutorial->id)
                            ->where('category_id', $tutorial->category_id)
                            ->orderBy('created_at', 'desc')
                            ->limit(8)
                            ->get();

        //Another tutorials for more                    
        $recommendedTutorials = Article::where('id', '!=', $tutorial->id)
                                    ->where('category_id', '!=', $tutorial->category_id)
                                    ->orderBy('created_at', 'desc')
                                    ->limit(8)
                                    ->get();

        //Category of tutorials                            
        $tutorialCategory = CategoryArticle::whereSlug('tutorials')->get()->first();

        return view('articles.tutorials.tutorial', [
            'tutorial' => $tutorial,
            'reletedTutotrials' => $reletedTutotrials,
            'recommendedTutorials' => $recommendedTutorials,
            'tutorialCategory' => $tutorialCategory
        ]);
    }


    public function tags(Request $request) 
    {       
        $tag = Tag::whereSlug($request->slug)->get()->first();
        

        //Category of tutorials                            
        $tutorialCategory = CategoryArticle::whereSlug('tutorials')->get()->first();

        //ids of tutorials
        $ids = $tutorialCategory->children->pluck('id');

        $tutorials = $tag->articles()->whereIn('category_id', $ids)->get();

        return view('articles.tag', [
            'tag' => $tag,
            'tutorials' => $tutorials,
            'tutorialCategory' => $tutorialCategory,
        ]);
    }


}

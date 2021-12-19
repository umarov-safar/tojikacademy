<?php
namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\CategoryArticle;
use App\Repositories\ArticleInterfaceRepository;
use Illuminate\Http\Request;
use Backpack\NewsCRUD\app\Models\Tag;
use DB;

class ArticleController extends Controller
{

    protected $articleRepository;

    public function __construct(ArticleInterfaceRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function news()
    {
        $parentCategory = CategoryArticle::where('slug', 'news')->get()->first();

        $allNews = $this->articleRepository->getFromSubCategories($parentCategory);

        return view('articles.news.index', [
            'allNews' => $allNews,
            'tutorialCategory' => $parentCategory,
        ]);
    }

    /**
     * Returns article with slug and recommended articles
     * Also returns category of tutorials and articles
    */
    public function newsContent(Request $request)
    {
        $news = $this->articleRepository->getBySlug($request->slug);

        $relatedNews = $this->articleRepository->getRelationArticles($news);

        $newsCategory = CategoryArticle::whereSlug('news')->get()->first();

        $recommendedNews = $this->articleRepository->recommendedArticles($news, $newsCategory->children->pluck('id'), 6);

        $tutorialCategory = CategoryArticle::where('slug', 'tutorials')->get()->first();

        $recommendedTutorials = $this->articleRepository->recommendedArticles($news, $tutorialCategory->children->pluck('id'), 5);

       return view('articles.news.content', [
           'news' => $news,
           'relatedNews' => $relatedNews,
           'newsCategory' => $newsCategory,
           'recommendedNews' => $recommendedNews,
           'recommendedTutorials' => $recommendedTutorials,
       ]);
    }

    public function newsCategory($slug)
    {
        $category = CategoryArticle::whereSlug($slug)->get()->first();

        $newsS = $this->articleRepository->category($category);

        $newsCategory = CategoryArticle::whereSlug('news')->get()->first();

        return view('articles.news.category', [
            'category' => $category,
            'newsS' => $newsS,
            'tutorialCategory' => $newsCategory,
        ]);
    }

    public function tutorials()
    {
        $parentCategory = CategoryArticle::where('slug', 'tutorials')->get()->first();

        $tutorials = $this->articleRepository->getFromSubCategories($parentCategory);

        return view('articles.tutorials.index', [
            'tutorials' => $tutorials,
            'tutorialCategory' => $parentCategory,
        ]);
    }

    /**
     * Showing category's articles
     * @param Request $request
     *
     */
    public function tutorialCategory($slug)
    {
        $category = CategoryArticle::whereSlug($slug)->get()->first();

        $tutorials = $this->articleRepository->category($category);

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
        // tutorial content
        $tutorial = $this->articleRepository->getBySlug($request->slug);

        //Tutorials in the same category
        $reletedTutotrials = $this->articleRepository->getRelationArticles($tutorial);


        //Category of tutorials
        $tutorialCategory = CategoryArticle::whereSlug('tutorials')->get()->first();

        //Another tutorials for more
        $recommendedTutorials = $this->articleRepository->recommendedArticles($tutorial, $tutorialCategory->children->pluck('id'));


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

        $slug = 'tutorials';

        if($request->parent == 'news')
        {
            $slug = 'news';
        } else if($request->parent == 'blogs') {
            $slug = 'blogs';
        }
        //Parent categories
        $tutorialCategory = CategoryArticle::whereSlug($slug)->get()->first();

        //ids of tutorials
        $ids = $tutorialCategory->children->pluck('id');

        $articles = $tag->articles()->whereIn('category_id', $ids)->get();

        return view('articles.tags', [
            'tag' => $tag,
            'articles' => $articles,
            'tutorialCategory' => $tutorialCategory,
            'parentSlug' => $slug,
        ]);
    }


}

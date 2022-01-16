<?php
namespace App\Repositories;

use App\Models\Article;
use App\Models\CategoryArticle;
use App\Repositories\ArticleInterfaceRepository;
use DB;

class ArticleRepository implements ArticleInterfaceRepository
{

    /**
     * Get all articles
     * @return Article
     */
    public function getAll()
    {
        return Article::all();
    }


    /**
     * Get article by id
     * @param int $id
     * @return Article
     */
    public function getById(int $id)
    {
        return Article::findOrFail($id);
    }


    /**
     * Get article by slug
     * @param string $slug
     * @return Article
     */
    public function getBySlug(string $slug)
    {
        return Article::where('slug', $slug)->get()->firstOrFail();
    }

    /**
     * Returns articles from other categories Article passed
     * @param Article
     * @param string $category
     * 
     */
    public function recommendedArticles(Article $article, $categories = null, int $limit = 8)
    {   
        return Article::where('id', '!=', $article->id)
                        ->where('category_id', '!=', $article->category_id)
                        ->whereIn('category_id', $categories)
                        ->orderBy('created_at', 'desc')
                        ->limit($limit)
                        ->get();
    }


    /**
     * Get related articles to the passed Article
     * @param Article
     * @return Article
     */
    public function getRelationArticles(Article $article, int $limit = 8)
    {
        return Article::where('id', '!=', $article->id)
                        ->where('category_id', $article->category_id)
                        ->orderBy('created_at', 'desc')
                        ->limit($limit)
                        ->get();
    }


    /**
     * Return articles from subcategories of parent category like news(russian, english) or tutorials (math, russian, english ...)
     * @param CategoryArticle
     */
    public function getFromSubCategories(CategoryArticle $category, int $inPage = 15)
    {
        $articles = DB::table('articles')
                        ->select(['*', 'categories.slug as cat_slug', 'articles.slug as slug'])
                        ->join('categories', function($join) use ($category) {
                                $join->on('categories.id', '=', 'articles.category_id')
                                ->where('categories.parent_id', $category->id);
                        })
                        ->paginate($inPage);
        
        return $articles;
    }


    /**
     * Articles of specific category
     * This for category page of articles
     * We could get category articles 
     */
    public function category(CategoryArticle $parent, int  $inPage = 15)
    {

        $articles = DB::table('articles')
                    ->select(['*', 'categories.slug as cat_slug', 'articles.slug as slug'])
                    ->join('categories', function($join) use ($parent) {
                    $join->on('categories.id', '=', 'articles.category_id')
                    ->where('categories.id', $parent->id);
                    })
                    ->paginate($inPage);
        
        return $articles;         
    }

}

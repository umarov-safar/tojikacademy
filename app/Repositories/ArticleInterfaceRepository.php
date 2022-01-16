<?php
namespace App\Repositories;

use App\Models\Article;
use App\Models\CategoryArticle;

interface ArticleInterfaceRepository
{
    public function getAll();

    public function getById(int $id);

    public function getBySlug(string $slug);

    public function recommendedArticles(Article $article, $categories = null, int $limit = 8);

    public function getRelationArticles(Article $article, int $limit = 8);

    public function category(CategoryArticle $category, int $inPage = 15);

    public function getFromSubCategories(CategoryArticle $category, int $inPage = 15);
}

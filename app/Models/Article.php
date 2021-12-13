<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends \Backpack\NewsCRUD\app\Models\Article
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'category_id',
        'image',
        'content',
        'slug',
        'status',
        'date',
        'featured',
        'created_at',
        'updated_at',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];



    protected static function boot()
    {
        parent::boot();
        self::saving(function ($article) {
            $arrPaths = imageResizer($article->image, 'articles', 'articles');
            $article->image_sizes = json_encode($arrPaths);
        });
    }


    /**
     * Small image for list
     */
    public function smallImage()
    {
        if($this->image_sizes)
        {
            $image = json_decode($this->image_sizes, true);
            return $image['400x300'];
        }
    }

    /**
     * Getting all Tutorial category
     */

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Article extends \Backpack\NewsCRUD\app\Models\Article
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory, HasRoles;

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

    protected $casts = ['image_sizes' => 'array'];

    protected static function boot()
    {
        parent::boot();
        self::saving(function ($article) {

            if(request()->isMethod('PUT')) {

                $oldArticle = Article::find($article->id);

                if($article->image === $oldArticle->image){
                    return;
                }
            }

            $arrPaths = imageResizer($article->image, 'articles', 'articles');
            $article->image_sizes = $arrPaths;

        });
    }

    public function category()
    {
        return $this->belongsTo('Backpack\NewsCRUD\app\Models\Category', 'category_id');
    }


}

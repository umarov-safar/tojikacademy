<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\NewsCRUD\app\Models\Category;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategoryArticle extends Category
{
    use CrudTrait;
    use Sluggable, SluggableScopeHelpers;

    public $originalName;


    public function articles(): HasMany
    {
        return $this->hasMany(Article::class, 'category_id', 'id');
    }

    

    public function getNameAttribute($value)
    {
        $this->originalName = $value;
        return @$this->parent->name ? $this->parent->name . ' - ' . $value : $value;
    }

}

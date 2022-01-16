<?php

namespace App\Services;

use App\Dtos\WordCategoryDto;
use App\Models\WordCategory;

class WordCategoryService {

    /**
     * @param WordCategoryDto $request
     * @return WordCategory|false
     */
    public function store(WordCategoryDto $request)
    {
        $wordCategory = new WordCategory();

        $wordCategory->name = $request->getName();
        $wordCategory->description = $request->getDescription();
        $wordCategory->image = $request->getImage();
        $wordCategory->slug = $request->getSlug();

        if(!$wordCategory->save()){
            return false;
        }

        return $wordCategory;
    }

    /**
     * @param WordCategoryDto $request
     * @param int $id
     * @return false
     */
    public function update(WordCategoryDto $request, int $id)
    {
        $wordCategory = WordCategory::find($id);

        $wordCategory->name = $request->getName();
        $wordCategory->description = $request->getDescription();
        $wordCategory->image = $request->getImage();
        $wordCategory->slug = $request->getSlug();

        if(!$wordCategory->update()){
            return false;
        }

        return $wordCategory;
    }
}

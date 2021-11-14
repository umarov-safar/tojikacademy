<?php

namespace App\Services;

use App\Dtos\WordCategoryDto;
use App\Models\WordCategory;

class WordCategoryService {

    public function store(WordCategoryDto $request)
    {
        $wordCategory = new WordCategory();

        $wordCategory->name = $request->getName();
        $wordCategory->description = $request->getDescription();

        if(!$wordCategory->save()){
            return false;
        }

        return $wordCategory;
    }

    public function update(WordCategoryDto $request, int $id)
    {
        $wordCategory = WordCategory::find($id);

        $wordCategory->name = $request->getName();
        $wordCategory->description = $request->getDescription();

        if(!$wordCategory->update()){
            return false;
        }

        return $wordCategory;
    }
}

<?php

namespace App\Services;

use App\Dtos\LanguageCategoryDto;
use App\Models\LanguageCategory;

class LanguageCategoryService {


    /**
     * @param LanguageCategoryDto $request
     * @return LanguageCategory|false
     */
    public function store(LanguageCategoryDto $request)
    {
        $langCategory = new LanguageCategory();

        $langCategory->name = $request->getName();
        $langCategory->slug = $request->getSlug();
        $langCategory->parent_id = $request->getParent();

        if(!$langCategory->save())
        {
            return false;
        }

        return $langCategory;
    }


    /**
     * @param LanguageCategoryDto $request
     * @return LanguageCategory|false
     */
    public function update(LanguageCategoryDto $request, int $id)
    {
        $langCategory = LanguageCategory::find($id);

        $langCategory->name = $request->getName();
        $langCategory->slug = $request->getSlug();
        $langCategory->parent_id = $request->getParent();

        if(!$langCategory->update()){
            return false;
        }

        return $langCategory;
    }

}

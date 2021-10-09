<?php

namespace App\Services;

use App\Dtos\QuestionCategoryDto;
use App\Models\QuestionCategory;

class QuestionCategoryService {

    /**
     * @param QuestionCategoryDto $request
     * @return QuestionCategory|false
     */
    public function store(QuestionCategoryDto $request)
    {
        $questionCategory = new QuestionCategory();

        $questionCategory->name = $request->getName();
        $questionCategory->slug = $request->getSlug();

        if(!$questionCategory->save()){
            return false;
        }

        return  $questionCategory;
    }


    /***
     * @param QuestionCategoryDto $request
     * @param $id
     * @return bool|QuestionCategory
     */
    public function update(QuestionCategoryDto $request, int $id)
    {
        $questionCategory = QuestionCategory::find($id);

        $questionCategory->name = $request->getName();
        $questionCategory->slug = $request->getSlug();

        if(!$questionCategory->update()) {
            return false;
        }

        return $questionCategory;
    }

}

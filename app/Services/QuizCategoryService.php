<?php

namespace App\Services;

use App\Dtos\QuizCategoryDto;
use App\Models\QuizCategory;

class QuizCategoryService {

    /**
     * @param QuizCategoryDto $request
     * @return QuizCategory|false
     */
    public function store(QuizCategoryDto $request)
    {
        $quizCategory = new QuizCategory();

        $quizCategory->name = $request->getName();
        $quizCategory->slug = $request->getSlug();
        $quizCategory->parent_id = $request->getParent();

        if(!$quizCategory->save())
        {
            return false;
        }

        return $quizCategory;
    }


    /**
     * @param QuizCategoryDto $request
     * @return LanguageCategory|false
     */
    public function update(QuizCategoryDto $request, int $id)
    {
        $quizCategory = QuizCategory::find($id);

        $quizCategory->name = $request->getName();
        $quizCategory->slug = $request->getSlug();
        $quizCategory->parent_id = $request->getParent();

        if(!$quizCategory->update()){
            return false;
        }

        return $quizCategory;
    }

}

<?php

namespace App\Services;

use App\Dtos\QuestionDto;
use App\Models\Question;

class QuestionService {


    /*
     |---------------------------------------------------------------------
     | FUNCTIONS
     |---------------------------------------------------------------------
     */

    /***
     * Function for creating question
     *
     * @param QuestionDto $questionDto
     * @return bool|\App\Models\Question
     */
    public function store(QuestionDto $request) {
        $question = new Question();

        $question->title = $request->getTitle();
        $question->body = $request->getBody();
        $question->image = $request->getImage();
        $question->user_id = $request->getUserId();
        $question->question_category_id = $request->getQuestionCategoryId();

        if(!$question->save()){
            return false;
        }

        return $question;

    }


    public function update(QuestionDto $request, int $id)
    {
        $question = Question::find($id);

        $question->title = $request->getTitle();
        $question->body = $request->getBody();
        $question->image = $request->getImage();
        $question->user_id = $request->getUserId();
        $question->question_category_id = $request->getQuestionCategoryId();

        if(!$question->update()){
            return false;
        }

        return $question;

    }


}

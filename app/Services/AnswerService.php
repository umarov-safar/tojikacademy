<?php

namespace App\Services;

use App\Dtos\AnswerDto;
use App\Models\Answer;

class AnswerService {


    /***
     * @param AnswerDto $request
     * @return Answer|false
     */
    public function store(AnswerDto $request)
    {
        $answer = new Answer();

        $answer->body = $request->getBody();
        $answer->image = $request->getImage();
        $answer->user_id = $request->getUserId();
        $answer->question_id = $request->getQuestionId();
        $answer->parent_id = $request->getParentId();

        if(!$answer->save())
        {
            return false;
        }

        return $answer;

    }

}

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

        $answer->answer = $request->getBody();
        $answer->user_id = $request->getUserId();
        $answer->answerable_type = $request->getAnswerableType();
        $answer->answerable_id = $request->getAnswerableId();

        if(!$answer->save())
        {
            return false;
        }

        return $answer;

    }

}

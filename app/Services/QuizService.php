<?php

namespace App\Services;

use App\Dtos\QuizDto;
use App\Models\Quiz;

class QuizService {

    /**
     * @param QuizDto $request
     * @return Quiz|false
     */
    public function store(QuizDto $request)
    {
        $quiz = new Quiz();

        $quiz->quiz = $request->getquiz();
        $quiz->answers = $request->getAnswers();
        $quiz->more_answer = $request->getMoreAnswer();
        $quiz->category_id = $request->getCategoryId();

        if(!$quiz->save()){
            return false;
        }

        return $quiz;
    }


    public function update(QuizDto $request, int $id)
    {
        $quiz = Quiz::find($id);

        $quiz->quiz = $request->getQuiz();
        $quiz->answers = $request->getAnswers();
        $quiz->more_answer = $request->getMoreAnswer();
        $quiz->category_id = $request->getCategoryId();

        if(!$quiz->update()){
            return false;
        }

        return $quiz;
    }

}

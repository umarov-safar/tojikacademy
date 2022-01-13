<?php

namespace App\Services;

use App\Dtos\EnglishWordDto;
use App\Models\EnglishWord;

class EnglishWordService {

    /**
     * @param EnglishWordDto $request
     * @return EnglishWord|false
     */
    public function store(EnglishWordDto $request)
    {
        $word = new EnglishWord();

        $word->english = $request->getEnglish();
        $word->tj = $request->getTj();
        $word->incorrect_answers = $request->getIncorrectAnswers();


        if($word->save()){
            $word->categories()->sync($request->getCategories());
            return $word;
        }

        return false;

    }



    /**
     * @param EnglishWordDto $request
     * @return EnglishWord|false
     */
    public function update(EnglishWordDto $request, int $id)
    {
        $word = EnglishWord::find($id);

        $word->english = $request->getEnglish();
        $word->tj = $request->getTj();
        $word->incorrect_answers = $request->getIncorrectAnswers();

        if($word->update()){

            $word->categories()->sync($request->getCategories());

            return $word;
        }

        return false;
    }



}

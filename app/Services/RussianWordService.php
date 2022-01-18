<?php

namespace App\Services;

use App\Dtos\RussianWordDto;
use App\Models\RussianWord;

class RussianWordService {

    /**
     * @param RussianWordDto $request
     * @return RussianWord|false
     */
    public function store(RussianWordDto $request)
    {
        $word = new RussianWord();

        $word->russian = $request->getRussian();
        $word->tj = $request->getTj();
        $word->incorrect_answers = $request->getIncorrectAnswers();
        $word->is_masculine = $request->isMasculine();
        $word->is_feminine = $request->isFeminine();
        $word->is_neutral = $request->isNeutral();
        $word->is_noun = $request->isNoun();
        $word->is_verb = $request->isVerb();
        $word->is_adjective = $request->isAdjective();

        if($word->save()){
            $word->categories()->sync($request->getCategories());
            return $word;
        }

        return false;

    }



    /**
     * @param RussianWordDto $request
     * @return RussianWord|false
     */
    public function update(RussianWordDto $request, int $id)
    {
        $word = RussianWord::find($id);

        $word->russian = $request->getRussian();
        $word->tj = $request->getTj();
        $word->incorrect_answers = $request->getIncorrectAnswers();
        $word->is_masculine = $request->isMasculine();
        $word->is_feminine = $request->isFeminine();
        $word->is_neutral = $request->isNeutral();
        $word->is_noun = $request->isNoun();
        $word->is_verb = $request->isVerb();
        $word->is_adjective = $request->isAdjective();

        if($word->update()){

            $word->categories()->sync($request->getCategories());

            return $word;
        }

        return false;
    }


}

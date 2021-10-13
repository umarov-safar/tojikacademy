<?php

namespace App\Services;

use App\Dtos\WordDto;
use App\Models\Word;

class WordService {


    /**
     * @param WordDto $request
     * @return Word|false
     */
    public function store(WordDto $request)
    {
        $word = new Word();

        $word->word = $request->getWord();
        $word->translate1 = $request->getTranslate1();
        $word->translate2 = $request->getTranslate2();
        $word->category_id = $request->getCategoryId();


        if($word->save()){
            return $word;
        }

        return false;

    }



    /**
     * @param WordDto $request
     * @return Word|false
     */
    public function update(WordDto $request, int $id)
    {
        $word = Word::find($id);

        $word->word = $request->getWord();
        $word->translate1 = $request->getTranslate1();
        $word->translate2 = $request->getTranslate2();
        $word->category_id = $request->getCategoryId();


        if($word->update()){
            return $word;
        }

        return false;
    }

}

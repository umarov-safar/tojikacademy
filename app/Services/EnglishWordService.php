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

        $word->word = $request->getWord();
        $word->translate = $request->getTranslate();


        if($word->save()){

            $word->words()->sync($request->getWords());
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

        $word->word = $request->getWord();
        $word->translate = $request->getTranslate();

        if($word->update()){

            $word->words()->sync($request->getWords());
            $word->categories()->sync($request->getCategories());

            return $word;
        }

        return false;
    }



}

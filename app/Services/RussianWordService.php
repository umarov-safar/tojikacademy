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
     * @param RussianWordDto $request
     * @return RussianWord|false
     */
    public function update(RussianWordDto $request, int $id)
    {
        $word = RussianWord::find($id);

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

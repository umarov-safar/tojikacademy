<?php

namespace App\Services;

use App\Dtos\EnglishDto;
use App\Models\English;

class EnglishService {


    /**
     * @param EnglishDto $request
     * @return English|false
     */
    public function store(EnglishDto $request)
    {

        $english = new English();

        $english->sentence = $request->getSentence();
        $english->translate1 = $request->getTranslate1();
        $english->translate2 = $request->getTranslate2();
        $english->category_id = $request->getCategoryId();

        if(!$english->save())
        {
            return false;
        }

        return  $english;
    }

    /**
     * @param EnglishDto $request
     * @param int $id
     * @return false|English
     */
    public function update(EnglishDto $request, int $id)
    {
        $english = English::find($id);

        $english->sentence = $request->getSentence();
        $english->translate1 = $request->getTranslate1();
        $english->translate2 = $request->getTranslate2();
        $english->category_id = $request->getCategoryId();

        if(!$english->update())
        {
            return false;
        }

        return  $english;
    }

}

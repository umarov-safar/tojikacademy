<?php

namespace App\Services;

use App\Dtos\RussianDto;
use App\Models\Russian;

class RussianService {

    /**
     * @param RussianDto $request
     * @return Russian|false
     */
    public function store(RussianDto $request)
    {

        $russian = new Russian();

        $russian->sentence = $request->getSentence();
        $russian->translate1 = $request->getTranslate1();
        $russian->translate2 = $request->getTranslate2();
        $russian->translate3 = $request->getTranslate3();
        $russian->category_id = $request->getCategoryId();

        if(!$russian->save())
        {
            return false;
        }

        return  $russian;

    }


    public function update(RussianDto $request, int $id)
    {
        $russian = Russian::find($id);

        $russian->sentence = $request->getSentence();
        $russian->translate1 = $request->getTranslate1();
        $russian->translate2 = $request->getTranslate2();
        $russian->translate3 = $request->getTranslate3();
        $russian->category_id = $request->getCategoryId();

        if(!$russian->update())
        {
            return false;
        }

        return  $russian;
    }


}

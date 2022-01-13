<?php

namespace App\Http\Controllers;

use App\Models\WordCategory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class EnglishWordController extends Controller
{

    //getting all categories for learning
    public function categories()
    {
       $wordCategories  =  WordCategory::all();

       return view('words.english.categories-words',
           compact('wordCategories')
       );
    }

    /**
     * get words those are in the slug  category
     * @param string $slug
     */
    public function learn(string $slug)
    {
        $category = WordCategory::with(['englishWords' => function(BelongsToMany $query) {
                                    return $query->inRandomOrder()->limit(100);
                                }])
                                ->whereSlug($slug)
                                ->get()
                                ->first();

        $words = $category->englishWords;

        //filtering data
        $wordsArray = [];
        foreach ($words as $word) {

            $entity = [];

            $entity['word'] = $word->english;

            //correct answer
            $entity['correct'] = $word->tj;

            $entity['incorrectWords'][] = $word->tj;

            foreach ($word->incorrect_answers[0] as $incorrect_answer => $key) {
                $entity['incorrectWords'][] = $key;
            }

            $wordsArray[] = $entity;

        }


        return view('words.english.learn', compact('wordsArray', 'category'));
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\WordCategory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class RussianWordController extends Controller
{

    //getting all categories for learning
    public function categories()
    {
       $wordCategories  =  WordCategory::all();

       return view('words.russian.categories-words',
           compact('wordCategories')
       );
    }

    /**
     * get words those are in the slug  category
     * @param string $slug
     */
    public function learn(string $slug)
    {
        $category = WordCategory::with(['russianWords' => function(BelongsToMany $query) {
                                    return $query->inRandomOrder()->limit(100);
                                }])->whereSlug($slug)
                                    ->get()
                                    ->first();

        $words = $category->russianWords;

        $wordsArray = [];
        foreach ($words as $word) {

            $entity = [];

            //set russian word
            $entity['word'] = $word->russian;

            //set correct answer
            $entity['correct'] = $word->tj;

            // adding correct word to incorrect words
            $entity['incorrectWords'][] = $word->tj;

            foreach ($word->incorrect_answers[0] as $incorrect_answer => $key) {
                $entity['incorrectWords'][] = $key;
            }

            $wordsArray[] = $entity;

        }

        return view('words.russian.learn', compact('wordsArray', 'category'));
    }

}

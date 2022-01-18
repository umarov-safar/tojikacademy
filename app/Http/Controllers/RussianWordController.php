<?php

namespace App\Http\Controllers;

use App\Models\RussianWord;
use App\Models\WordCategory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class RussianWordController extends Controller
{

    /**
     * This constant has a list of words type.
     */
    const SPECIAL_SLUGS = ['masculine', 'feminine', 'neutral', 'noun', 'verb', 'adjective'];


    //getting all categories for learning
    public function categories()
    {
       $wordCategories  =  WordCategory::orderBy('lft')->get();

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
                                    return $query->inRandomOrder()->limit(50);
                                }])->whereSlug($slug)
                                  ->get()
                                  ->firstOrFail();

        $words = $category->russianWords;

        $wordsArray = self::makeWordTasks($words);

        return view('words.russian.learn', compact('wordsArray', 'category'));
    }


    public function learnSpecial(string $slug)
    {
        if(!in_array($slug, self::SPECIAL_SLUGS)) {
            abort(404);
        }

        $category = WordCategory::whereSlug('specials/'.$slug)->get()->first();

        $words = RussianWord::where('is_'.$slug, true)->inRandomOrder()->limit(50)->get();

        $wordsArray = self::makeWordTasks($words);

        return view('words.russian.learn', compact('wordsArray', 'category'));

    }

    /**
     * Make task for words with incorrect answers
     * @param $words
     * @return array
     */
    protected function makeWordTasks($words): array
    {
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

        return $wordsArray;
    }

}

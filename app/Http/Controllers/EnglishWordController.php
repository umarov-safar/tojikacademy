<?php

namespace App\Http\Controllers;

use App\Models\EnglishWord;
use App\Models\WordCategory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class EnglishWordController extends Controller
{

    /**
     * This constant has a list of words type.
     */
    const SPECIAL_SLUGS = ['noun', 'verb', 'adjective'];




    //getting all categories for learning
    public function categories()
    {
        $wordCategories  =  WordCategory::orderBy('lft')->whereNotIn('slug', WordCategory::SPECIALS_SLUG_FOR_RUSSIAN_WORDS)->get();

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
                                ->firstOrFail();
        $words = $category->englishWords;

        $wordsArray = self::makeWordTasks($words);

        return view('words.english.learn', compact('wordsArray', 'category'));
    }

    public function learnSpecial(string $slug)
    {
        if(!in_array($slug, self::SPECIAL_SLUGS)) {
            abort(404);
        }

        $category = WordCategory::whereSlug('specials/'.$slug)->get()->first();

        $words = EnglishWord::where('is_'.$slug, true)->inRandomOrder()->limit(50)->get();

        $wordsArray = self::makeWordTasks($words);

        return view('words.english.learn', compact('wordsArray', 'category'));

    }


    protected function makeWordTasks($words) : array
    {
        $wordsArray = [];

        foreach ($words as $word) {

            $entity = [];

            //set russian word
            $entity['word'] = $word->english;

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

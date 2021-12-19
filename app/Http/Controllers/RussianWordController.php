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
                                }])
                                ->whereSlug($slug)
                                ->get()
                                ->first();

        $words = $category->russianWords;

        $wordsArray = [];
        foreach ($words as $key => $entry)
        {
            $word = [];

            $word['correct'] = $entry->toArray();

            $word['incorrectWords'][] = $entry->translate;

            foreach ($entry->words as $k => $incWord)
            {
                $word['incorrectWords'][] = $incWord->translate;
            }

            $wordsArray[] = $word;
        }

        return view('words.russian.learn', compact('wordsArray', 'category'));
    }

}
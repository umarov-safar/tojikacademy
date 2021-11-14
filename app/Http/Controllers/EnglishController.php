<?php

namespace App\Http\Controllers;

use App\Models\English;
use App\Models\Question;
use App\Models\QuestionCategory;
use Illuminate\Http\Request;

class EnglishController extends Controller
{
    /**
     * Return main page english and questions
     */
    public function index()
    {
        //getting english category
        $category = QuestionCategory::whereSlug('english')
                                        ->get()
                                        ->firstOrFail();

        //question english
        $questions = Question::where('question_category_id', $category->id)
                                ->orderBy('created_at', 'desc')
                                ->limit(10)
                                ->get();

        return view('lessons.english', ['questions' => $questions]);
    }


    public function get(Request $request)
    {
        $howMany = $request->get('howMany');
        $howMany = $howMany == 'infinity' ? 1 : $howMany;

        $data =  English::inRandomOrder()->limit($howMany)->get();
        return response($data);
    }
}

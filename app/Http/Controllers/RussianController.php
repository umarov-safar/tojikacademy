<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\QuestionCategory;
use App\Models\Russian;
use Illuminate\Http\Request;

class RussianController extends Controller
{
    /**
     * Return main page english and questions
     */
    public function index()
    {
        //getting english category
        $category = QuestionCategory::whereSlug('russian')
                                        ->get()
                                        ->first();

        //question english
        $questions = Question::where('question_category_id', $category->id)
                                ->orderBy('created_at', 'desc')
                                ->limit(10)
                                ->get();

        return view('lessons.russian', ['questions' => $questions]);
    }


    public function get(Request $request)
    {
        $howMany = $request->get('howMany');
        $howMany = $howMany == 'infinity' ? 1 : $howMany;

        $data =  Russian::inRandomOrder()->limit($howMany)->get();
        return response($data);
    }
}

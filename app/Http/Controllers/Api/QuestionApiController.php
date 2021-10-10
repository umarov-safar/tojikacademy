<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionApiController extends Controller
{
    public function search(Request $request)
    {
        //getting query
        $search_query = $request->get('q');

        //if not empty
        if($search_query) {
            return Question::select('title', 'id')->where('title', 'LIKE', '%' . $search_query . '%')->paginate(10);
        }
    }
}

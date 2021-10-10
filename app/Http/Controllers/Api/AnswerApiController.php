<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use Illuminate\Http\Request;

class AnswerApiController extends Controller
{

    public function search(Request $request)
    {
        //getting query
        $search_query = $request->get('q');

        //if not empty
        if($search_query) {
            return Answer::select('answer', 'id', 'parent_id')->where('answer', 'LIKE', '%' . $search_query . '%')->paginate(10);
        }
    }
}

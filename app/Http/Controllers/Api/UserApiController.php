<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserApiController extends Controller
{

    public function search(Request $request)
    {
        //getting query
        $search_query = $request->get('q');

        //if not empty
        if($search_query) {
           return User::select('name', 'id')->where('name', 'LIKE', '%' . $search_query . '%')->paginate(10);
        }
    }
}

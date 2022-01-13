<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\English;
use Illuminate\Http\Request;

class EnglishWordController extends Controller
{
    public function get(Request $request)
    {
        $howMany = $request->get('howMany');
        $howMany = $howMany == 'infinity' ? 1 : $howMany;

        $data =  English::inRandomOrder()->limit($howMany)->get();
        return response($data);
    }
}

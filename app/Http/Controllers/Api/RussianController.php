<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Russian;
use Illuminate\Http\Request;

class RussianController extends Controller
{
    public function get(Request $request)
    {
        $howMany = $request->get('howMany');
        $howMany = $howMany == 'infinity' ? 1 : $howMany;

        $data =  Russian::inRandomOrder()->limit($howMany)->get();
        return response($data);
    }
}

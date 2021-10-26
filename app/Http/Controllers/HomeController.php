<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {

        $questions = [];
        return view('welcome', compact('questions'));
    }

}

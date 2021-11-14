<?php

namespace App\Http\Controllers;

use App\Models\Word;
use Illuminate\Http\Request;

class WordController extends Controller
{
    public function index()
    {
        return view('words.index');
    }



    public function russian()
    {
        $word = Word::all()->first();
        return view('words.russian', ['word' => $word]);
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\RussianWord;
use App\Models\WordCategory;
use Illuminate\Http\Request;

class WordController extends Controller
{
    public function index()
    {
        return view('words.index');
    }



    public function russian()
    {
        $wordCategories = WordCategory::all();
        return view('words.russian', ['wordCategories' => $wordCategories]);
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use Illuminate\Http\Request;

class SponsorControoler extends Controller
{
    public function index()
    {
        $sponsors = Sponsor::all();

        return view('pages.sponsors', compact('sponsors'));
    }
}

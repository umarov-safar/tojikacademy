<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('account.login');
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }


    public function check(LoginRequest $request)
    {
       $logged =  Auth::attempt(['email' => $request->email, 'password' => $request->password]);

       if($logged) {
           return redirect('/');
       }

       return back()->withErrors(['error' => 'Почтаи электрони ё рамз нодуруст аст!']);
    }

}

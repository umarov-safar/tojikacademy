<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Providers\AuthServiceProvider;
use App\Providers\RouteServiceProvider;
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
       $logged =  Auth::attempt(['username' => $request->username, 'password' => $request->password]);

       if($logged) {
           return redirect(RouteServiceProvider::HOME);
       }

       return back()->withErrors(['error' => 'Ном ё рамз нодуруст аст!']);
    }

}

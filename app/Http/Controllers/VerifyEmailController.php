<?php

namespace App\Http\Controllers;

use App\Dtos\EmailVerifyDto;
use App\Models\EmailVerify;
use App\Models\User;

class VerifyEmailController extends Controller
{
    public function index()
    {
        return view('account.email_verify');
    }

    public function emailVerify($token)
    {
        $verify_email = EmailVerify::where('token', $token)->get()->first();

        $user = User::where('id', $verify_email->user_id)
                    ->where('is_email_verified', false)
                    ->update(['is_email_verified' => true]);

        if(!$user) {
            return redirect(route('login'));
        }

        \Auth::loginUsingId($verify_email->user_id);

        return redirect('/');
    }

}

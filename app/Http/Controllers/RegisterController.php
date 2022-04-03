<?php

namespace App\Http\Controllers;

use App\Dtos\EmailVerifyDto;
use App\Dtos\RegisterDto;
use App\Http\Requests\RegisterRequest;
use App\Mail\EmailVerify;
use App\Models\User;
use App\Services\EmailVerifyService;
use App\Services\RegisterService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    /**
     * @var RegisterService
     */
    protected RegisterService $service;

    public function __construct()
    {
        $this->service = new RegisterService();

    }

    public function register()
    {
        return view('account.register');
    }

    public function create(RegisterRequest $request)
    {

        $request->password = Hash::make($request->password);

        $dto = new RegisterDto(
            $request->name,
            $request->username,
            $request->email,
            $request->password,
        );

        $user = $this->service->create($dto);

        if($user) {
            return redirect(route('login'));
        }
        return back()->withInput()->withErrors(['message' => 'Бо кадом мушкилие ба қайд гирифта нашуд']);
    }


}

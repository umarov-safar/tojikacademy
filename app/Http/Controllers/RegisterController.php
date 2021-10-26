<?php

namespace App\Http\Controllers;

use App\Dtos\RegisterDto;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Services\RegisterService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

        //uploading file and get path
        $avatar = null;
        if($request->file('avatar')){
           $avatar = upload_user_image($request->file('avatar'));
        }

        $request->password = Hash::make($request->password);
            $dto = new RegisterDto(
            $request->name,
            $request->last_name,
            $request->email,
            $request->password,
            $request->avatar
        );

        $user = $this->service->create($dto);

        if($user) {
            Auth::login($user);
            return redirect('/');
        }

        return back()->withInput()->withErrors(['message' => 'Бо кадом мушкилие ба қайд гирифта нашуд']);

    }

}

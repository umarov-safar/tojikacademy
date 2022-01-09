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

        //uploading file and get path

        if($request->file('avatar')){

            $image_sizes = upload_images($request->file('avatar'), 'users', 'users/');

            $avatar = time() . $request->file('avatar')->getClientOriginalName();

            $request->file('avatar')->move(public_path('uploads/users'), $avatar);

            $request->avatar = 'uploads/users/' . $avatar;

        } else {
            $image_sizes = [
                '100x100' => 'uploads/users/user.png',
                '460x460' => 'uploads/users/user.png'
            ];
        }

        $request->password = Hash::make($request->password);
            $dto = new RegisterDto(
            $request->name,
            $request->last_name,
            $request->email,
            $request->password,
            $request->avatar,
            $image_sizes
        );

        $user = $this->service->create($dto);

        if($user) {
            $token = \Str::random(64);
            $email_verify = new EmailVerifyDto(
                $user->id,
                $token,
            );

            $saved_email_verify = (new EmailVerifyService())->create($email_verify);

            if($saved_email_verify) {

                Mail::to($user)->send(new EmailVerify($user, $token));

                return redirect(url('account/login'))->with('email_verify', __('login.email_verify_message'));

            } else {
                return back()->withInput()->withErrors(['message' => 'Бо кадом мушкилие ба қайд гирифта нашуд']);
            }
        }

        return back()->withInput()->withErrors(['message' => 'Бо кадом мушкилие ба қайд гирифта нашуд']);
    }


    public function update(RegisterRequest $request, $id)
    {
        if($request->file('avatar')){

            $image_sizes = upload_images($request->file('avatar'), 'users', 'users/');

            $avatar = time() . $request->file('avatar')->getClientOriginalName();

            $request->file('avatar')->move(public_path('uploads/users'), $avatar);

            $request->avatar = 'uploads/users/' . $avatar;

        } else {
            $image_sizes = [
                '100x100' => 'uploads/users/user.png',
                '460x460' => 'uploads/users/user.png'
            ];
        }

        $request->password = Hash::make($request->password);
        $dto = new RegisterDto(
            $request->name,
            $request->last_name,
            $request->email,
            $request->password,
            $request->avatar,
            $image_sizes
        );

        $user = $this->service->update($dto, $id);

        if($user) {
            return back()->withInput()->withErrors(['message' => 'Шумо бо муваффақона маълумотатонро тағир додед!']);
        }

        return back()->withInput()->withErrors(['message' => 'Бо кадом мушкилие ба қайд гирифта нашуд']);

    }

}

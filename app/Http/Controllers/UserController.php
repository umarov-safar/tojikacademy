<?php

namespace App\Http\Controllers;

use App\Dtos\UserDto;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    protected UserService $userService;

    /**
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }


    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show(User $user)
    {
        return view('account.user', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(UserRequest $request, $id)
    {
        $request->password = Hash::make($request->password);
        $dto = new UserDto(
            $request->name,
            $request->username,
            $request->password,
            $request->email,
        );

        $user = $this->userService->update($dto, $id);

        if($user) {
            return back()->withInput()->with(['success' => 'Шумо бо муваффақона маълумотатонро тағир додед!']);
        }

        return back()->withInput()->with(['error' => 'Бо кадом мушкилие ба қайд гирифта нашуд']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        //
    }

    public function changeAvatar(Request $request, $id)
    {
        $request->validate([
            'avatar' => 'nullable|mimes:jpg,png,jpeg,webp'
        ]);

        $user = User::find($id);

        //uploading file and get path
        $image_sizes = NULL;
        if($request->file('avatar')){

            $image_sizes = upload_images($request->file('avatar'), 'users', 'users/');

            $avatar = time() . $request->file('avatar')->getClientOriginalName();

            $request->file('avatar')->move(public_path('uploads/users'), $avatar);

            $request->avatar = 'uploads/users/' . $avatar;
        }

        $dto = new UserDto(
          $user->name,
          $user->username,
          $user->password,
          $user->email,
            $request->avatar,
            $image_sizes
        );

        $user = $this->userService->update($dto, $id);

        if($user) {
            return back()->withInput()->with(['successPhoto' => 'Шумо бо муваффақона аксатонро тағир додед!']);
        }

        return back()->withInput()->with(['errorPhoto' => 'Бо кадом мушкилие акс таъғир дода нашуд']);

    }
}

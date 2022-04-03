<?php

namespace App\Services;

use App\Dtos\RegisterDto;
use App\Models\User;


class RegisterService {

    public function create(RegisterDto $request)
    {
        $user = new User();

        $user->name = $request->getName();
        $user->username = $request->getUsername();
        $user->email = $request->getEmail();
        $user->password = $request->getPassword();

        if($user->save()) return $user;

        return false;
    }


    public function update(RegisterDto $request, int $id)
    {
        $user = User::find($id);

        $user->name = $request->getName();
        $user->username = $request->getUsername();
        $user->email = $request->getEmail();
        $user->password = $request->getPassword();

        if($user->update()) return $user;

        return false;
    }

}

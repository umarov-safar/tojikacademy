<?php

namespace App\Services;

use App\Dtos\RegisterDto;
use App\Models\User;


class RegisterService {

    public function create(RegisterDto $request)
    {
        $user = new User();

        $user->name = $request->getName();
        $user->last_name = $request->getLastName();
        $user->email = $request->getEmail();
        $user->password = $request->getPassword();
        $user->avatar = $request->getAvatar();

        if($user->save()) return $user;

        return false;
    }

}

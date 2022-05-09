<?php

namespace App\Services;

use App\Dtos\UserDto;
use App\Models\User;

class UserService {

    public function create(UserDto $request)
    {
        $user = new User();

        self::setModelProperties($user, $request);

        if($user->save()) return $user;

        return false;
    }


    public function update(UserDto $request, int $id)
    {
        $user = User::find($id);

        self::setModelProperties($user, $request);

        if($user->save()) return $user;

        return false;
    }

    private static function setModelProperties(User $user, UserDto $request) : User
    {
        $user->name = $request->getName();
        $user->username = $request->getUsername();
        $user->email = $request->getEmail();
        $user->password = $request->getPassword();
        $user->avatar = $request->getAvatar() ?? $user->avatar;
        $user->image_sizes = $request->getImageSizes() ?? $user->image_sizes;

        return $user;
    }
}

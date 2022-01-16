<?php

namespace App\Services;

use App\Dtos\EmailVerifyDto;
use App\Models\EmailVerify;

class EmailVerifyService {

    /**
     * @param EmailVerifyDto $request
     * @return false|EmailVerify
     */
    public function create(EmailVerifyDto $request)
    {
        $email_verify = EmailVerify::create([
            'user_id' => $request->getUserId(),
            'token' => $request->getToken(),
        ]);

        if(!$email_verify) return false;

        return $email_verify;

    }
}

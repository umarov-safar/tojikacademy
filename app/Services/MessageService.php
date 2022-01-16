<?php

namespace App\Services;

use App\Dtos\MessageDto;
use App\Models\Message;

class MessageService {

    public function create(MessageDto $request)
    {
        $message = new Message();

        $message->name = $request->getName();
        $message->contact = $request->getContact();
        $message->message = $request->getMessage();

        if($message->save()) {
            return $message;
        }

        return false;
    }

}

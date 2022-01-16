<?php

namespace App\Http\Controllers;

use App\Dtos\MessageDto;
use App\Http\Requests\MessageRequest;
use App\Services\MessageService;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    protected MessageService $service;

    public function __construct()
    {
        $this->service = new MessageService();
    }

    public function send(MessageRequest $request)
    {

        $dto = new MessageDto(
            $request->name,
            $request->contact,
            $request->message
        );

        $message = $this->service->create($dto);

        if($message) {
            return back()->with(['responseMessage' => 'Шумо паёматонро фиристодед! Мо ба шумо ба зуди ҷавоб медиҳем.']);
        }
        return back()->with(['responseMessage' => 'Бо кадом мушкилие паём фиристода нашуд. Лутфан дар почати эл. нависед!']);

    }

}

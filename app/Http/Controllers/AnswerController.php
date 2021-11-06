<?php

namespace App\Http\Controllers;

use App\Dtos\AnswerDto;
use App\Http\Requests\AnswerRequest;
use App\Services\AnswerService;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    protected AnswerService $answerService;

    public function __construct()
    {
        $this->answerService = new AnswerService();
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
     */
    public function store(AnswerRequest $request)
    {
        $request->answer = upload_image64($request->answer, 'questions/answers');
        $answerable_type = getModelNamespaceName('question');
        $dto = new AnswerDto(
            $request->answer,
            \Auth::id(),
            $answerable_type,
            $request->answerable_id,
        );

        $answer =  $this->answerService->store($dto);

        if($answer) return back()->with('message', 'Шумо ба муваффақият ҷавоб гузоштед!');

        return back()->withErrors(['error' => 'Савол гузошта нашуд! Ба администратор нависед']);

    }

    /**
     * Display the specified resource.
     * @param  int  $id
     *
     */
    public function show(int $id)
    {

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
    public function update(Request $request, $id)
    {
        //
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
}

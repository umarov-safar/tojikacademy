<?php

namespace App\Http\Controllers;

use App\Dtos\AnswerDto;
use App\Http\Requests\AnswerRequest;
use App\Models\Answer;
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
        $request->answer = upload_image64(html_entity_decode($request->answer), 'questions/answers');
        $answerable_type = getModelNamespace($request->answerable_type);
        $dto = new AnswerDto(
            $request->answer,
            \Auth::id(),
            $answerable_type,
            $request->answerable_id,
            $request->parent_id
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
     * @param  int  $id
     */
    public function edit($id)
    {
        $answer = Answer::find($id);
        return view('answers-questions.edit-answer', ['answer' => $answer]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(AnswerRequest $request, $id)
    {
        $answer = Answer::find($id);

        $answer->answer = upload_image64(html_entity_decode($request->answer), 'answers');

        if($answer->save()) {
            return back()->with(['message' => 'Шумо бо муваффақиёна ҷавобро тағаир додед!']);
        }

        return back()->withErrors(['error' => 'ҷавоб тағир дода нашуд!']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        $answer = Answer::find($id);
        $answer->answers()->delete();

        $answer->delete();

        return back();
    }
}

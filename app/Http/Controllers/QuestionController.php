<?php

namespace App\Http\Controllers;

use App\Dtos\QuestionDto;
use App\Http\Requests\QuestionRequest;
use App\Models\Question;
use App\Models\QuestionCategory;
use App\Services\QuestionService;
use Illuminate\Http\Request;

class QuestionController extends Controller
{

    protected QuestionService $questionService;

    public function __construct()
    {
        return $this->questionService = new QuestionService();
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {
        $categories = QuestionCategory::all();
        $questions = $request->has('category') ? Question::where('category_id', $request->category) : Question::orderBy('created_at', 'desc')->paginate(20);

        return view('answerquestion.questions')
            ->with([
                'categories' => $categories,
                'questions' => $questions
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('answerquestion.create')
            ->with([
                'categories' => QuestionCategory::all(),
                'questions' => []
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(QuestionRequest $request)
    {
        if($request->body){
            $request->body = upload_image64($request->body, 'questions');
        }

        $dto = new QuestionDto(
            $request->title,
            $request->body,
            $request->slug,
            \Auth::id(),
            $request->category
        );

        $question = $this->questionService->store($dto);

        if($question) {
            return back()->with(['message' => 'Шумо бо муваффақиёна савол гузоштед!']);
        }

        return back()->withErrors(['error' => 'Савол сохта нашуд бо кадом мушкиле!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     */
    public function show($slug)
    {
        $question = Question::where('slug', $slug)->firstOrFail();
        $questions=[];
        return view('answerquestion.show', compact('question', 'questions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $question = Question::findOrFail($id);

        return view('answerquestion.edit')
            ->with([
                'categories' => QuestionCategory::all(),
                'question' => $question,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(QuestionRequest $request, $id)
    {

        if($request->body){
            $request->body = upload_image64($request->body, 'questions');
        }

        $dto = new QuestionDto(
            $request->title,
            $request->body,
            $request->slug,
            \Auth::id(),
            $request->category
        );

        $question = $this->questionService->update($dto, $id);

        if($question) {
            return back()->with(['message' => 'Шумо бо муваффақиёна саволро тағаир додед!']);
        }

        return back()->withErrors(['error' => 'Савол тағир дода нашуд!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     */
    public function destroy(int $id)
    {
        // find and remove likes
       $question = Question::find($id);
       $question->likes()->delete();
       $question->dislikes()->delete();

       //remove model
       $question = $question->delete();

       if($question) {
           return back();
       }

    }
}

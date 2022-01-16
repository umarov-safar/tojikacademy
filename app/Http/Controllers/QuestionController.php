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
        $questions =  $this->orderedQuestions($request);

        return view('answers-questions.questions')
            ->with([
                'categories' => $categories,
                'questions' => $questions
            ]);
    }

    /**
     * Ordering question
     * @param Request $request
     * @return Questions
     */
    public function orderedQuestions(Request $request) {

        if($request->has('orderWith')){

            switch($request->orderWith){
                case 'desc':
                    return Question::orderBy('created_at', 'desc')->paginate(10);
                break;
                case 'asc':
                    return Question::orderBy('created_at', 'asc')->paginate(10);
                break;
                case 'month':
                    return Question::orderBy('created_at', 'desc')
                                    ->whereMonth('created_at', date('m'))
                                    ->whereYear('created_at', date('Y'))
                                    ->paginate(10);
                break;
                case 'day':
                    return Question::orderBy('created_at', 'desc')
                                    ->whereDay('created_at', date('d'))
                                    ->paginate(10);
               break;
            }
        }

        return Question::orderBy('created_at', 'desc')->paginate(30);

    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {

        return view('answers-questions.create')
            ->with([
                'categories' => QuestionCategory::all(),
                'questions' => Question::limit(10)->orderBy('created_at', 'desc')->get()
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(QuestionRequest $request)
    {
        if($request->body){
            $request->body = upload_image64(html_entity_decode($request->body), 'questions');
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
    public function show(Request $request)
    {

        $question = Question::where('slug', $request->slug)->firstOrFail();

        $questions= Question::where('question_category_id', $question->question_category_id)
                            ->where('id', '!=', $question->id)
                            ->limit(5)
                            ->get();

        $categories = QuestionCategory::all();

        return view('answers-questions.show', compact('question', 'questions', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $question = Question::findOrFail($id);

        return view('answers-questions.edit')
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
        // find and remove likes and answers to this answers
       $question = Question::findOrFail($id);

       $question->likes()->delete();
       $question->dislikes()->delete();

       $question->answers()->delete();

       //remove model
       $question = $question->delete();

       if($question) {
           return redirect('/');
       }
    }

    /**
     * Get category questions
     * @param string $slug
     */
    public function category($slug)
    {

        $category = QuestionCategory::where('slug', $slug)->get()->firstOrFail();

        $categories = QuestionCategory::all();

        $questions = Question::where('question_category_id', $category->id)
                                ->orderBy('created_at', 'desc')
                                ->paginate(2);

        return view('answers-questions.category_with_questions', compact('category', 'categories', 'questions'));
    }



}

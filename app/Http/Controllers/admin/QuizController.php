<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Http\Requests\StoreQuizRequest;
use App\Http\Requests\UpdateQuizRequest;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $quizzes = Quiz::withCount('getQuestions');

        if ($request->quiz) {
            $quizzes->where('quiz_title', 'like', "%$request->quiz%");
        }

        if ($request->status) {
            $quizzes->whereQuizStatus($request->status);
        }

        $quizzes = $quizzes->paginate(5);
        return view('admin.quiz.index', compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.quiz.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuizRequest $request)
    {
        Quiz::create($request->validated()) ?? abort(400);
        toastr()->success('The quiz successfully created!');
        return redirect()->route('quizzes.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($quiz_id)
    {
        $quiz = Quiz::withCount('getQuestions')->findOrFail($quiz_id);
        return view('admin.quiz.edit', compact('quiz'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateQuizRequest $request, $quiz_id)
    {
        $questionCount = Quiz::withCount('getQuestions')->findOrFail($quiz_id)->get_questions_count;

        if ($questionCount < 4 && $request->quiz_status === 'publish') {
            toastr()->error('Question count error! Do not try this!');
            return redirect()->route('quizzes.edit', $quiz_id);
        }

        Quiz::findOrFail($quiz_id)->updateOrFail($request->validated());
        toastr()->success('The quiz successfully updated!');
        return redirect()->route('quizzes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $quiz_id = intval($request->quiz_id);
        Quiz::findOrFail($quiz_id)->delete();
        toastr()->success('The quiz successfully deleted!');
        return redirect()->route('quizzes.index');
    }
}

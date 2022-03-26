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
    public function index()
    {
        $quizzes = Quiz::paginate(5);
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
        $quiz = Quiz::findOrFail($quiz_id);
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

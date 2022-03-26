<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use Illuminate\Support\Facades\File;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($quiz_id)
    {
        $quiz = Quiz::findOrFail($quiz_id);
        $questions = $quiz->getQuestions()->paginate(5);
        return view('admin.question.index', compact('quiz', 'questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($quiz_id)
    {
        $quiz = Quiz::findOrFail($quiz_id);
        return view('admin.question.create', compact('quiz'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuestionRequest $request, $quiz_id)
    {
        if ($request->question_image && $request->question_image->isValid()) {
            $newFileName = uniqid() . '_' . $request->question_image->getClientOriginalName();
            $request->question_image->move(public_path('uploads'), $newFileName);
            $request->merge([
                'question_image' => $newFileName
            ]);
        }

        Quiz::findOrFail($quiz_id)->getQuestions()->create($request->post()) ?? abort(400);
        toastr()->success('The question successfully created!');
        return redirect()->route('questions.create', $quiz_id);
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
    public function edit($quiz_id, $question_id)
    {
        $quiz = Quiz::findOrFail($quiz_id);
        $question = $quiz->getQuestions()->findOrFail($question_id);
        return view('admin.question.edit', compact('quiz', 'question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateQuestionRequest $request, $quiz_id, $question_id)
    {
        $question = Quiz::findOrFail($quiz_id)->getQuestions()->findOrFail($question_id);
        $currentFile = public_path('uploads') . '/' . $question->question_image;

        if ($request->delete_image) {
            if (File::exists($currentFile)) {
                File::delete($currentFile);
            }
            $request->merge([
                'question_image' => null
            ]);
        }

        if ($request->question_image && $request->question_image->isValid()) {
            if (File::exists($currentFile)) {
                File::delete($currentFile);
            }

            $newFileName = uniqid() . '_' . $request->question_image->getClientOriginalName();
            $request->question_image->move(public_path('uploads'), $newFileName);
            $request->merge([
                'question_image' => $newFileName
            ]);
        }

        $question->update($request->post());
        toastr()->success('The question successfully updated!');
        return redirect()->route('questions.index', $quiz_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $quiz_id)
    {
        $question_id = intval($request->question_id);

        $question = Quiz::findOrFail($quiz_id)->getQuestions()->findOrFail($question_id);
        $currentFile = public_path('uploads') . '/' . $question->question_image;

        if (File::exists($currentFile)) {
            File::delete($currentFile);
        }

        $question->delete();
        toastr()->success('The question successfully deleted!');
        return redirect()->route('questions.index', $quiz_id);
    }
}

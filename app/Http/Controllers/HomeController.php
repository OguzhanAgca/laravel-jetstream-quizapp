<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Quiz;
use App\Models\Result;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function quizzes()
    {
        $quizzes = Quiz::where('quiz_status', 'publish')->where(function ($query) {
            $query->where('finished_at', '>', now())->orWhere('finished_at', null);
        })->withCount('getQuestions')->paginate(7);

        $results = auth()->user()->getAuthUserResults;

        return view('home.index', compact('quizzes', 'results'));
    }

    public function quizDetail($quiz_slug)
    {
        $quiz = Quiz::whereQuizSlug($quiz_slug)->with('getTopTenUser.getUser')->withCount('getQuestions')->first() ?? abort(404);
        return view('home.quiz_detail', compact('quiz'));
    }

    public function quizJoin($quiz_slug)
    {
        $quiz = Quiz::whereQuizSlug($quiz_slug)->with('getQuestions')->first() ?? abort(404);
        return view('home.quiz_join', compact('quiz'));
    }

    public function quizStore(Request $request, $quiz_slug)
    {
        $quiz = Quiz::with('getQuestions')->where('quiz_slug', $quiz_slug)->first() ?? abort(404);

        if ($quiz->getAuthUserResult()) {
            toastr()->error('You have already taken the exam!');
            return redirect()->route('quiz.detail', $quiz_slug);
        }

        $answers = [];

        $totalQuestion = count($quiz->getQuestions);
        $correct = 0;
        $empty = 0;
        foreach ($quiz->getQuestions as $question) {
            if ($request->post($question->question_id) === $question->correct_answer) {
                $correct++;
            } elseif (!$request->post($question->question_id)) {
                $empty++;
            }

            array_push($answers, [
                'user_id' => auth()->user()->id,
                'question_id' => $question->question_id,
                'answer' => $request->post($question->question_id)
            ]);
        }
        $wrong = $totalQuestion - ($correct + $empty);
        $oneQuestionScore = round(100 / $totalQuestion);
        $score = $oneQuestionScore * $correct;

        Answer::insert($answers);
        Result::insert([
            'user_id' => auth()->user()->id,
            'quiz_id' => $quiz->quiz_id,
            'score' => $score,
            'correct' => $correct,
            'wrong' => $wrong,
            'empty' => $empty
        ]);

        toastr()->success('Congratulations! Your score is ' . $score);
        return redirect()->route('quiz.detail', $quiz_slug);
    }

    public function quizResult($quiz_slug)
    {
        $quiz = Quiz::with('getQuestions.getUserAnswers')->where('quiz_slug', $quiz_slug)->first() ?? abort(404);
        return view('home.quiz_result', compact('quiz'));
    }
}

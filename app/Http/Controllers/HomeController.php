<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
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
}

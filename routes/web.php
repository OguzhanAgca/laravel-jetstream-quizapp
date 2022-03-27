<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\admin\QuizController;
use App\Http\Controllers\admin\QuestionController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::get('/quizzes', [HomeController::class, 'quizzes'])->name('quizzes.home');
    Route::get('/quiz/{slug}/detail', [HomeController::class, 'quizDetail'])->name('quiz.detail');
});

// Route::middleware()->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

Route::group([
    'middleware' => ['auth:sanctum', 'verified', 'is.admin'],
    'prefix' => '/dashboard'
], function () {
    Route::post('/quizzes/delete', [QuizController::class, 'destroy'])->name('quizzes.delete');
    Route::post('/quizzes/{quiz}/questions/delete', [QuizController::class, 'destroy'])->name('questions.delete');
    Route::resources([
        '/quizzes' => QuizController::class,
        '/quizzes/{quiz}/questions' => QuestionController::class
    ]);
});

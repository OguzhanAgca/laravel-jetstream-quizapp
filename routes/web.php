<?php

use App\Http\Controllers\admin\QuizController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::get('/quizzes', [HomeController::class, 'quizzes'])->name('quizzes.home');
});

// Route::middleware()->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

Route::group([
    'middleware' => ['auth:sanctum', 'verified', 'is.admin'],
    'prefix' => '/dashboard'
], function () {
    Route::resources([
        '/quizzes' => QuizController::class
    ]);
});

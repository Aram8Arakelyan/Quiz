<?php

use App\Http\Controllers\Auth\DashboardController;
use App\Http\Controllers\Auth\QuestionsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\QuizController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/quiz', [QuizController::class, "index"])->name('quiz');
    Route::get('/delete-quiz/{id}', [QuizController::class, "deleteQuiz"])->name('delete-quiz');
    Route::get('/delete-result/{id}', [QuizController::class, "deleteResult"])->name('delete-result');
    Route::get('/show-results/{id}', [QuizController::class, "showResults"])->name('show-results');
    Route::get('/delete-question/{id}', [QuestionsController::class, "deleteQuestion"])->name('delete-question');
    Route::get('/create-quiz', [QuizController::class, "createNewQuiz"])->name('create-quiz');
    Route::get('/dashboard', [DashboardController::class, "index"])->name('dashboard');
    Route::get('/questions/{id}', [QuestionsController::class, "index"])->name('question');
    Route::get('/add-question/{quiz_id}', [QuestionsController::class, "addQuestion"])->name('add-question');
    Route::get('/send-students', [QuizController::class, "sendToStudents"])->name('send-students');
});

Route::get('/start-quiz/{email}/{id}', [QuizController::class, "startQuiz"])->name('start-quiz');
Route::post('/send-result', [QuizController::class, "sendResult"])->name('send-result');


require __DIR__ . '/auth.php';

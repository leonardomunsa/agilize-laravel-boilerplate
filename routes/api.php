<?php

use App\Http\Controllers\ExamController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/student', [StudentController::class, 'list']);
Route::post('/student', [StudentController::class, 'store']);

Route::get('/subject', [SubjectController::class, 'list']);
Route::post('/subject', [SubjectController::class, 'store']);

Route::get('/question', [QuestionController::class, 'list']);
Route::post('/question', [QuestionController::class, 'store']);

Route::post('/question/{id}/option', [OptionController::class, 'store']);

Route::post('/student/{id}/exam', [ExamController::class, 'store']);
Route::put('/exam/{id}/finish', [ExamController::class, 'update']);


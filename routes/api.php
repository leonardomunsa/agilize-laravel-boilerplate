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

Route::post('/student', [StudentController::class, 'store']);

Route::post('/subject', [SubjectController::class, 'store']);

Route::post('/question', [QuestionController::class, 'store']);

Route::post('/question/{id}/option', [OptionController::class, 'store']);

Route::post('/student/{id}/exam', [ExamController::class, 'store']);


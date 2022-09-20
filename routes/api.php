<?php

use App\Packages\Exam\Controller\OptionController;
use App\Packages\Exam\Controller\SubjectController;
use App\Packages\Student\Controller\StudentController;
use App\Packages\Exam\Controller\QuestionController;
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

Route::post('/option', [OptionController::class, 'store']);

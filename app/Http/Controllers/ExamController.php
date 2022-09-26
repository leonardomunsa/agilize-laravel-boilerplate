<?php

namespace App\Http\Controllers;

use App\Packages\Exam\Facade\ExamFacade;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use LaravelDoctrine\ORM\Facades\EntityManager;

class ExamController extends Controller
{
    public function __construct(
        protected ExamFacade $subjectFacade
    )
    {
    }

    /**
     * @throws Exception
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $studentId = $request->header('id');
            $subjectName = $request->get('subject');

            $response = $this->subjectFacade->startExam($studentId, $subjectName);
//            EntityManager::flush();
            return response()->json($response);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage(), 1663106115);
        }
    }
}
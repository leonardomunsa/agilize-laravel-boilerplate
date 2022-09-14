<?php

namespace App\Packages\Exam\Controller;

use App\Http\Controllers\Controller;
use App\Packages\Exam\Facade\SubjectFacade;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function __construct(
        protected SubjectFacade $subjectFacade

    )
    {
    }

    /**
     * @throws Exception
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $studentName = $request->get('name');

            $response = $this->subjectFacade->enrollSubject($studentName);
            return response()->json($response);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage(), 1663106115);
        }
    }
}
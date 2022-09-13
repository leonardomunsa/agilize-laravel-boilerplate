<?php

namespace App\Packages\Student\Controller;

use App\Http\Controllers\Controller;
use App\Packages\Student\Facade\StudentFacade;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use LaravelDoctrine\ORM\Facades\EntityManager;

class StudentController extends Controller
{
    public function __construct(
        protected StudentFacade $studentFacade
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

            $response = $this->studentFacade->enrollStudent($studentName);
            return response()->json($response);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage(), 1663076218);
        }
    }
}
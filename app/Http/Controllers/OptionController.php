<?php

namespace App\Http\Controllers;

use App\Packages\Exam\Facade\ExamFacade;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use LaravelDoctrine\ORM\Facades\EntityManager;

class OptionController
{
    public function __construct(
        protected ExamFacade $examFacade
    )
    {
    }

    /**
     * @throws Exception
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $options = $request->get('options');
            $questionId = $request->header('id');
            $response = $this->examFacade->enrollOptions($options, $questionId);

            EntityManager::flush();
            return response()->json($response);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage(), 1663286854);
        }
    }
}
<?php

namespace App\Packages\Exam\Controller;

use App\Packages\Exam\Facade\ExamFacade;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
            $questionId = $request->input('id');
            $response = $this->examFacade->enrollOptions($options, $questionId);

            return response()->json($response);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage(), 1663286854);
        }
    }
}
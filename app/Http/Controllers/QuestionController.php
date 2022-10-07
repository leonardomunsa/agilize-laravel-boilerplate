<?php

namespace App\Http\Controllers;

use App\Packages\Exam\Facade\ExamFacade;
use App\Packages\Exam\Model\Question;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use LaravelDoctrine\ORM\Facades\EntityManager;

class QuestionController
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
            $questionContent = $request->get('content');
            $subjectId = $request->get('subject');

            $response = $this->examFacade->enrollQuestion($questionContent, $subjectId);
            EntityManager::flush();
            return response()->json($response);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage(), 1663266116);
        }
    }

    /**
     * @throws Exception
     */
    public function list(Request $request): JsonResponse
    {
        try {
            $questions = $this->examFacade->getQuestions();
            $response = $this->getQuestionsCollection($questions);

            return response()->json($response);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage(), 1665067619);
        }
    }

    private function getQuestionsCollection(array $questions): \Illuminate\Support\Collection
    {
        $questionsCollections = collect();

        /** @var Question $question */
        foreach ($questions as $question) {
            $questionsCollections->add([
                'id' => $question->getId(),
                'question' => $question->getQuestion(),
                'options' =>
                    array_map(function ($option) {
                        return [
                            'id' => $option->getId(),
                            'content' => $option->getContent(),
                            'correct' => $option->isCorrect()
                        ];
                    }, $question->getOptions()->toArray())
            ]);
        }

        return $questionsCollections;
    }
}
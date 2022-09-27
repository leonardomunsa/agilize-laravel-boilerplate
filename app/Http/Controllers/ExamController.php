<?php

namespace App\Http\Controllers;

use App\Packages\Exam\Facade\ExamFacade;
use App\Packages\Exam\Model\Exam;
use App\Packages\Exam\Model\Question;
use App\Packages\Exam\Model\QuestionRegister;
use App\Packages\Student\Facade\StudentFacade;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use LaravelDoctrine\ORM\Facades\EntityManager;

class ExamController extends Controller
{
    public function __construct(
        protected ExamFacade $subjectFacade,
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
            $studentId = $request->header('id');
            $subjectName = $request->get('subject');

            $student = $this->studentFacade->getStudent($studentId);
            $exam = $this->subjectFacade->startExam($student, $subjectName);
            $questionsWithOptions = $this->getQuestionsWithOptions($exam);

            $response = [
                'name' => $student->getName(),
                'subject' => $subjectName,
                'questions_amount' => $exam->getQuestionsAmount(),
                'start_time' => Carbon::now()->timezone('America/Bahia')->format('h:i:s'),
                'finish_until' => Carbon::now()->addHour()->timezone('America/Bahia')->format('h:i:s'),
                'questions' => $questionsWithOptions
            ];
            EntityManager::flush();
            return response()->json($response);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage(), 1663106115);
        }
    }

    private function getQuestionsWithOptions($exam) {
        /** @var Exam $exam */
        $questions = $exam->getQuestions();
        $examCollection = collect();
        /** @var QuestionRegister $question */
        foreach ($questions as $question) {
            $examCollection->add([
                'question_id' => $question->getId(),
                'content' => $question->getContent(),
                'options' =>
                    array_map(function ($option) {
                        return [
                            'option_id' => $option->getId(),
                            'content' => $option->getContent()
                        ];
                    }, $question->getOptions()->toArray())
            ]);
        }
        return $examCollection;
    }
}
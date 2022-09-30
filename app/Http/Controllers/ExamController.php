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
        protected ExamFacade $examFacade,
        protected StudentFacade $studentFacade
    )
    {
    }

    /**
     * @throws Exception
     */
    public function update(Request $request): JsonResponse
    {
        try {
            $examId = $request->route('id');
            $answers = $request->get('answers');
            $exam = $this->examFacade->getExam($examId);
            $response = [
                'grade' => $this->examFacade->finishExam($exam, $answers),
                'questions' => $this->getQuestionsFromExam($exam)
            ];

            return response()->json($response);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage(), 1664314822);
        }
    }

    /**
     * @throws Exception
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $studentId = $request->route('id');
            $subjectName = $request->get('subject');

            $student = $this->studentFacade->getStudent($studentId);
            $exam = $this->examFacade->startExam($student, $subjectName);

            $response = [
                'name' => $student->getName(),
                'subject' => $subjectName,
                'questions_amount' => $exam->getQuestionsAmount(),
                'start_time' => $exam->getStartTime()->format('h:i:s'),
                'finish_until' => $exam->getStartTime()->addHour()->format('h:i:s'),
                'questions' => $this->getQuestionsWithOptions($exam)
            ];
            EntityManager::flush();
            return response()->json($response);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage(), 1663106115);
        }
    }

    private function getQuestionsWithOptions(Exam $exam)
    {
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

    private function getQuestionsFromExam(Exam $exam)
    {
        $questions = $exam->getQuestions();
        $examCollection = collect();
        /** @var QuestionRegister $question */
        foreach ($questions as $question) {
            $examCollection->add([
                'content' => $question->getContent(),
                'options' =>
                    array_map(function ($option) {
                        return [
                            'content' => $option->getContent(),
                            'picked' => $option->isPicked(),
                            'correct' => $option->isCorrect()
                        ];
                    }, $question->getOptions()->toArray())
            ]);
        }
        return $examCollection;
    }
}
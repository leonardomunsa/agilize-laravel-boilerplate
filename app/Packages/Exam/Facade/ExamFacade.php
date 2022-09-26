<?php

namespace App\Packages\Exam\Facade;

use App\Packages\Exam\Model\Question;
use App\Packages\Exam\Service\ExamService;
use App\Packages\Exam\Service\OptionService;
use App\Packages\Exam\Service\QuestionService;
use App\Packages\Exam\Service\SubjectService;
use App\Packages\Student\Facade\StudentFacade;

class ExamFacade
{
    public function __construct(
        protected SubjectService $subjectService,
        protected QuestionService $questionService,
        protected OptionService $optionService,
        protected ExamService $examService,
        protected StudentFacade $studentFacade
    )
    {
    }

    public function enrollSubject(string $name): string
    {
        return $this->subjectService->enrollSubject($name);
    }

    public function enrollQuestion(string $content, string $subject): string
    {
        return $this->questionService->enrollQuestion($content, $subject);
    }

    public function enrollOptions(array $options, string $questionId): string
    {
        return $this->optionService->enrollOptions($options, $questionId);
    }

    public function startExam(string $studentId, string $subjectName)
    {
        $student = $this->studentFacade->getStudent($studentId);
        $questions = $this->examService->startExam($student, $subjectName);
        $questionsCollection = collect();
        /** @var Question $question */
        foreach ($questions as $question) {
            $questionsCollection->add([
                'question' => $question->getQuestion(),
                'options' =>
                    array_map(function ($option) {
                        return $option->getContent();
                    }, $question->getOptions()->toArray())
            ]);
        }

        return $questionsCollection;
    }
}
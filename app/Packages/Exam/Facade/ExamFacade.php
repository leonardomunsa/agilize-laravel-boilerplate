<?php

namespace App\Packages\Exam\Facade;

use App\Packages\Exam\Model\Exam;
use App\Packages\Exam\Model\Question;
use App\Packages\Exam\Service\ExamService;
use App\Packages\Exam\Service\OptionService;
use App\Packages\Exam\Service\QuestionService;
use App\Packages\Exam\Service\SubjectService;
use App\Packages\Student\Facade\StudentFacade;
use App\Packages\Student\Model\Student;

class ExamFacade
{
    public function __construct(
        protected SubjectService $subjectService,
        protected QuestionService $questionService,
        protected OptionService $optionService,
        protected ExamService $examService,
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

    public function startExam(Student $student, string $subjectName)
    {
        return $this->examService->startExam($student, $subjectName);
    }

    public function finishExam(Exam $exam, array $answers)
    {
        return $this->examService->finishExam($exam, $answers);
    }

    public function getExam(string $examId)
    {
        return $this->examService->getExam($examId);
    }
}
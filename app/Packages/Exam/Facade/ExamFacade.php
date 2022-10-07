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
use Exception;

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

    public function getSubjects(): array
    {
        return $this->subjectService->getSubjects();
    }

    /**
     * @throws Exception
     */
    public function enrollQuestion(string $content, string $subjectId): string
    {
        return $this->questionService->enrollQuestion($content, $subjectId);
    }

    public function getQuestions(): array
    {
        return $this->questionService->getQuestions();
    }

    /**
     * @throws Exception
     */
    public function enrollOptions(array $options, string $questionId): string
    {
        return $this->optionService->enrollOptions($options, $questionId);
    }

    public function startExam(Student $student, string $subjectId): Exam
    {
        return $this->examService->startExam($student, $subjectId);
    }

    /**
     * @throws Exception
     */
    public function finishExam(Exam $exam, array $answers): float
    {
        return $this->examService->finishExam($exam, $answers);
    }

    public function getExam(string $examId)
    {
        return $this->examService->getExam($examId);
    }
}
<?php

namespace App\Packages\Exam\Facade;

use App\Packages\Exam\Service\QuestionService;
use App\Packages\Exam\Service\SubjectService;

class ExamFacade
{
    public function __construct(
        protected SubjectService $subjectService,
        protected QuestionService $questionService
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
}
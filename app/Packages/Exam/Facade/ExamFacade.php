<?php

namespace App\Packages\Exam\Facade;

use App\Packages\Exam\Model\Question;
use App\Packages\Exam\Service\OptionService;
use App\Packages\Exam\Service\QuestionService;
use App\Packages\Exam\Service\SubjectService;

class ExamFacade
{
    public function __construct(
        protected SubjectService $subjectService,
        protected QuestionService $questionService,
        protected OptionService $optionService
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
}
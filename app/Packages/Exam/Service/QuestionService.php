<?php

namespace App\Packages\Exam\Service;

use App\Packages\Exam\Model\Question;
use App\Packages\Exam\Repository\QuestionRepository;
use App\Packages\Exam\Repository\SubjectRepository;

class QuestionService
{
    public function __construct(
        protected QuestionRepository $questionRepository,
        protected SubjectRepository $subjectRepository
    )
    {
    }

    public function enrollQuestion(string $content, string $subject): string
    {
        $subject = $this->subjectRepository->findSubjectByName($subject);
        $question = new Question($content, $subject);
        $this->questionRepository->addQuestion($question);
        return 'Question registered!';
    }
}
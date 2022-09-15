<?php

namespace App\Packages\Exam\Service;

use App\Packages\Exam\Model\Question;
use App\Packages\Exam\Repository\QuestionRepository;
use App\Packages\Exam\Repository\SubjectRepository;

class QuestionService
{
    const MIN_LENGTH_QUESTION = 10;

    public function __construct(
        protected QuestionRepository $questionRepository,
        protected SubjectRepository $subjectRepository
    )
    {
    }

    public function enrollQuestion(string $content, string $subject): string
    {
        if (!$this->checkIfQuestionIsEmpty($content)) {
            $subject = $this->subjectRepository->findSubjectByName($subject);
            $question = new Question($content, $subject);
            $this->questionRepository->addQuestion($question);
            return 'Question registered!';
        }
        return 'Please submit a real question';
    }

    public function checkIfQuestionIsEmpty(string $content): bool
    {
        return $content < self::MIN_LENGTH_QUESTION;
    }
}
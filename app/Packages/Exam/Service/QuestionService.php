<?php

namespace App\Packages\Exam\Service;

use App\Packages\Exam\Model\Question;
use App\Packages\Exam\Repository\QuestionRepository;
use App\Packages\Exam\Repository\SubjectRepository;
use Exception;

class QuestionService
{
    const MIN_LENGTH_QUESTION = 10;

    public function __construct(
        protected QuestionRepository $questionRepository,
        protected SubjectRepository $subjectRepository
    )
    {
    }

    /**
     * @throws Exception
     */
    public function enrollQuestion(string $content, string $subjectId): string
    {
        if (!$this->checkIfQuestionIsEmpty($content)) {
            $subject = $this->subjectRepository->findSubjectById($subjectId);
            $question = new Question($content, $subject);
            $this->questionRepository->addQuestion($question);
            return 'Question registered!';
        }
        throw new Exception('Please submit a real question', 1664994335);
    }

    private function checkIfQuestionIsEmpty(string $content): bool
    {
        return $content < self::MIN_LENGTH_QUESTION;
    }
}
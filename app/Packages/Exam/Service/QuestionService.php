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
        if ($this->checkIfQuestionIsTooShort($content)) {
            throw new Exception('The question should have at least ten characters', 1664994335);
        }
        $subject = $this->subjectRepository->findSubjectById($subjectId);
        $question = new Question($content, $subject);
        $this->questionRepository->addQuestion($question);
        return 'Question registered!';
    }

    private function checkIfQuestionIsTooShort(string $content): bool
    {
        return strlen($content) < self::MIN_LENGTH_QUESTION;
    }

    public function getQuestions(): array
    {
        return $this->questionRepository->findAllQuestions();
    }
}
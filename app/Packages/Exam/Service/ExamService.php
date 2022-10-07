<?php

namespace App\Packages\Exam\Service;

use App\Packages\Exam\Model\Exam;
use App\Packages\Exam\Model\Option;
use App\Packages\Exam\Model\OptionRegister;
use App\Packages\Exam\Model\Question;
use App\Packages\Exam\Model\QuestionRegister;
use App\Packages\Exam\Model\Subject;
use App\Packages\Exam\Repository\ExamRepository;
use App\Packages\Exam\Repository\OptionRegisterRepository;
use App\Packages\Exam\Repository\QuestionRepository;
use App\Packages\Exam\Repository\SubjectRepository;
use App\Packages\Student\Facade\StudentFacade;
use App\Packages\Student\Model\Student;
use Carbon\Carbon;
use Doctrine\ORM\NonUniqueResultException;
use Exception;

class ExamService
{
    public function __construct(
        protected ExamRepository $examRepository,
        protected SubjectRepository $subjectRepository,
        protected QuestionRepository $questionRepository,
    )
    {
    }

    public function startExam(Student $student, string $subjectId): Exam
    {
        $subject = $this->subjectRepository->findSubjectById($subjectId);
        $amountOfQuestions = $this->getAmountOfQuestions();
        $exam = new Exam($amountOfQuestions, 'open', $subject, $student);
        $this->examRepository->startExam($exam);
        $this->createQuestionsSnapshot($exam, $amountOfQuestions, $subject);
        return $exam;
    }

    /**
     * @throws Exception
     */
    public function finishExam(Exam $exam, array $answers): float
    {
        $this->updatePickedOptions($answers);
        $numberOfRightAnswers = $this->examRepository->getNumberOfRightAnswers($exam)[0][1];
        $exam->closeStatus();
        $exam->endTime();
        $this->examRepository->updateExam($exam);

        if ($exam->getEndTime()->diffInRealSeconds($exam->getStartTime()) > 3600) {
            throw new Exception('The time limit for submitting the exam has expired', 1664485702);
        }

        return $exam->getGrade($numberOfRightAnswers);
    }

    private function getAmountOfQuestions(): int
    {
        return rand(10, 40);
    }

    private function createQuestionsSnapshot(Exam $exam, int $amountOfQuestions, Subject $subject): void
    {
        $questions = $this->questionRepository->getAmountOfQuestions($amountOfQuestions, $subject);
        /** @var Question $question */
        foreach ($questions as $question) {
            $questionSnapshot = new QuestionRegister($question->getQuestion(), $exam);
            $this->examRepository->createQuestionsRegister($questionSnapshot);
            $this->createOptionsSnapshot($question, $questionSnapshot);
            $exam->addQuestion($questionSnapshot);
        }
    }

    private function createOptionsSnapshot($question, $questionSnapshot): void
    {
        /** @var Question $question */
        $options = $question->getOptions();
        /** @var Option $option */
        /** @var QuestionRegister $questionSnapshot */
        foreach ($options as $option) {
            $optionSnapshot = new OptionRegister($option->getContent(), $option->isCorrect(), $questionSnapshot);
            $this->examRepository->createOptionsRegister($optionSnapshot);
            $questionSnapshot->addOption($optionSnapshot);
        }
    }

    public function getExam($examId): Exam
    {
        return $this->examRepository->findExamById($examId);
    }

    private function updatePickedOptions(array $answers): void
    {
        foreach ($answers as $answer) {
            $this->examRepository->updatePickedOptions($answer['option']);
        }
    }
}
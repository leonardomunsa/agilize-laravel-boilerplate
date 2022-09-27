<?php

namespace App\Packages\Exam\Service;

use App\Packages\Exam\Model\Exam;
use App\Packages\Exam\Model\Option;
use App\Packages\Exam\Model\OptionRegister;
use App\Packages\Exam\Model\Question;
use App\Packages\Exam\Model\QuestionRegister;
use App\Packages\Exam\Model\Subject;
use App\Packages\Exam\Repository\ExamRepository;
use App\Packages\Exam\Repository\QuestionRepository;
use App\Packages\Exam\Repository\SubjectRepository;
use App\Packages\Student\Facade\StudentFacade;
use App\Packages\Student\Model\Student;
use Carbon\Carbon;
use Doctrine\ORM\NonUniqueResultException;

class ExamService
{
    public function __construct(
        protected ExamRepository $examRepository,
        protected SubjectRepository $subjectRepository,
        protected QuestionRepository $questionRepository
    )
    {
    }

    public function startExam(Student $student, string $subjectName)
    {
        $startTimeOfExam = Carbon::now()->timezone('America/Bahia');
        $subject = $this->subjectRepository->findSubjectByName($subjectName);
        $amountOfQuestions = $this->getAmountOfQuestions();
        $exam = new Exam($amountOfQuestions, 'open', $subject, $startTimeOfExam, $student);
        $this->examRepository->startExam($exam);
        $this->createQuestionsSnapshot($exam, $amountOfQuestions, $subject);
        return $exam;
    }

    public function getAmountOfQuestions(): int
    {
        return rand(10, 40);
    }


    public function createQuestionsSnapshot(Exam $exam, int $amountOfQuestions, Subject $subject): void
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

    public function createOptionsSnapshot($question, $questionSnapshot)
    {
        /** @var Question $question */
        $options = $question->getOptions();
        /** @var Option $option */
        /** @var QuestionRegister $questionSnapshot */
        foreach ($options as $option) {
            $optionSnapshot = new OptionRegister($option->getContent(), $option->isCorrect(), $question);
            $this->examRepository->createOptionsRegister($optionSnapshot);
            $questionSnapshot->addOption($optionSnapshot);
        }
    }
}
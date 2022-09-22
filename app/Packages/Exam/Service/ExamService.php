<?php

namespace App\Packages\Exam\Service;

use App\Packages\Exam\Model\Exam;
use App\Packages\Exam\Repository\ExamRepository;
use App\Packages\Exam\Repository\SubjectRepository;
use App\Packages\Student\Model\Student;
use Carbon\Carbon;

class ExamService
{
    public function __construct(
        protected ExamRepository $examRepository,
        protected SubjectRepository $subjectRepository
    )
    {
    }

    public function startExam(Student $student, string $subjectName)
    {
        $startTimeOfExam = Carbon::now();
        $subject = $this->subjectRepository->findSubjectByName($subjectName);
        $amountOfQuestions = $this->getAmountOfQuestions();
        $exam = new Exam($amountOfQuestions, 'open', $subject, $startTimeOfExam, $student);
        $this->examRepository->startExam($exam);
        return 'You have 1 hour to submit your answers. You have to submit your Exam until ' . $startTimeOfExam->addHour();
    }

    public function getAmountOfQuestions(): int
    {
        return rand(10, 40);
    }
}
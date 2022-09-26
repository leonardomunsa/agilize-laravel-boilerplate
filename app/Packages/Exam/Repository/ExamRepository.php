<?php

namespace App\Packages\Exam\Repository;

use App\Packages\Base\AbstractRepository;
use App\Packages\Exam\Model\Exam;
use App\Packages\Exam\Model\OptionRegister;
use App\Packages\Exam\Model\QuestionRegister;
use LaravelDoctrine\ORM\Facades\EntityManager;

class ExamRepository extends AbstractRepository
{
    public string $entityName = Exam::class;

    public function startExam(Exam $exam)
    {
        EntityManager::persist($exam);
    }

    public function createQuestionsRegister(QuestionRegister $questionRegister)
    {
        EntityManager::persist($questionRegister);
    }

    public function createOptionsRegister(OptionRegister $optionRegister)
    {
        EntityManager::persist($optionRegister);
    }
}
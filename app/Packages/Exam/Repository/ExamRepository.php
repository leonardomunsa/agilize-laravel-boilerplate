<?php

namespace App\Packages\Exam\Repository;

use App\Packages\Base\AbstractRepository;
use App\Packages\Exam\Model\Exam;
use LaravelDoctrine\ORM\Facades\EntityManager;

class ExamRepository extends AbstractRepository
{
    public string $entityName = Exam::class;

    public function startExam(Exam $exam)
    {
        EntityManager::persist($exam);
    }
}
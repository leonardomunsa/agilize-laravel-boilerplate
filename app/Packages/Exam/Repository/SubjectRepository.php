<?php

namespace App\Packages\Exam\Repository;

use App\Packages\Base\AbstractRepository;
use App\Packages\Exam\Model\Subject;
use LaravelDoctrine\ORM\Facades\EntityManager;

class SubjectRepository extends AbstractRepository
{
    public string $entityName = Subject::class;

    public function addSubject(Subject $subject)
    {
        EntityManager::persist($subject);
    }

    public function findSubjectById(string $subjectId): ?Subject
    {
        return $this->findOneBy(['id' => $subjectId]);
    }

    public function findAllSubjects(): array
    {
        return $this->findAll();
    }
}
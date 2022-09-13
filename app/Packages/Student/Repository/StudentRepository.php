<?php

namespace App\Packages\Student\Repository;

use App\Packages\Base\AbstractRepository;
use App\Packages\Student\Model\Student;
use LaravelDoctrine\ORM\Facades\EntityManager;

class StudentRepository extends AbstractRepository
{
    public string $entityName = Student::class;

    public function addStudent(Student $student)
    {
        EntityManager::persist($student);
        EntityManager::flush();
    }
}
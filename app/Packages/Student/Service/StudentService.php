<?php

namespace App\Packages\Student\Service;

use App\Packages\Student\Model\Student;
use App\Packages\Student\Repository\StudentRepository;
use LaravelDoctrine\ORM\Facades\EntityManager;

class StudentService
{
    const MIN_LENGTH_NAME = 3;

    public function __construct(
        protected StudentRepository $studentRepository
    )
    {
    }

    public function enrollStudent(string $name): string
    {
        if (!$this->checkIfStudentNameIsTooShort($name)) {
            $student = new Student($name);
            $this->studentRepository->addStudent($student);
            return 'Student ' . $name . ' registered!';
        }
        return 'Not enough letters';
    }

    protected function checkIfStudentNameIsTooShort(string $name): bool
    {
        return strlen($name) < self::MIN_LENGTH_NAME;
    }

    public function getStudent(string $studentId): Student
    {
        return $this->studentRepository->findStudentById($studentId);
    }
}
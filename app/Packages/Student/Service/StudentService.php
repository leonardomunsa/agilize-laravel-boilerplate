<?php

namespace App\Packages\Student\Service;

use App\Packages\Student\Model\Student;
use App\Packages\Student\Repository\StudentRepository;
use Exception;
use LaravelDoctrine\ORM\Facades\EntityManager;

class StudentService
{
    const MIN_LENGTH_NAME = 3;

    public function __construct(
        protected StudentRepository $studentRepository
    )
    {
    }

    /**
     * @throws Exception
     */
    public function enrollStudent(string $name): string
    {
        if (!$this->checkIfStudentNameIsTooShort($name)) {
            $student = new Student($name);
            $this->studentRepository->addStudent($student);
            return 'Student ' . $name . ' registered!';
        }
        throw new Exception('The name is too short', 1664905181);
    }

    private function checkIfStudentNameIsTooShort(string $name): bool
    {
        return strlen($name) < self::MIN_LENGTH_NAME;
    }

    public function getStudent(string $studentId): Student
    {
        return $this->studentRepository->findStudentById($studentId);
    }
}
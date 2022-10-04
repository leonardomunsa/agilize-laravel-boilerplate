<?php

namespace App\Packages\Student\Facade;

use App\Packages\Student\Model\Student;
use App\Packages\Student\Service\StudentService;
use Exception;

class StudentFacade
{
    public function __construct(
        protected StudentService $studentService
    )
    {
    }

    /**
     * @throws Exception
     */
    public function enrollStudent(string $name): string
    {
        return $this->studentService->enrollStudent($name);
    }

    public function getStudent(string $studentId): Student
    {
        return $this->studentService->getStudent($studentId);
    }
}
<?php

namespace App\Packages\Student\Facade;

use App\Packages\Student\Service\StudentService;

class StudentFacade
{
    public function __construct(
        protected StudentService $studentService
    )
    {
    }

    public function enrollStudent(string $name): string
    {
        return $this->studentService->enrollStudent($name);
    }
}
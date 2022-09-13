<?php

namespace App\Packages\Student\Service;

use App\Packages\Student\Model\Student;

class StudentService
{
    const MIN_LENGTH_NAME = 3;

    public function __construct()
    {
    }

    public function enrollStudent(string $name): string
    {
        if ($this->checkStudentName($name)) {
            new Student($name);
            return 'Student ' . $name . ' registered!';
        }
        return 'Not enough letters';
    }

    protected function checkStudentName(string $name): bool
    {
        return strlen($name) < self::MIN_LENGTH_NAME;
    }
}
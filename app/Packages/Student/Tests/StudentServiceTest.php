<?php

namespace App\Packages\Student\Tests;

use App\Packages\Student\Model\Student;
use App\Packages\Student\Repository\StudentRepository;
use App\Packages\Student\Service\StudentService;
use Exception;
use Tests\TestCase;

class StudentServiceTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testItShouldReturnExpectedString()
    {
        /** @var StudentService $studentService */
        $studentService = app(StudentService::class);
        $result = 'Student James registered!';

        $student = $studentService->enrollStudent('James');

        $this->assertSame($student, $result);
    }

    /**
     * @throws Exception
     */
    public function testItShouldThrowAnException()
    {
        $this->expectExceptionMessage('The name is too short');

        /** @var StudentService $studentService */
        $studentService = app(StudentService::class);
        $studentService->enrollStudent('a');
    }

    public function testItShouldReturnAStudentObject()
    {
        $student = new Student('Bob');
        $studentRepositoryMock = $this->createMock(StudentRepository::class);
        $studentRepositoryMock->method('findStudentById')->willReturn($student);

        $studentService = new StudentService($studentRepositoryMock);
        $result = $studentService->getStudent($student->getId());

        $this->assertSame($student, $result);
    }
}
<?php

namespace App\Packages\Student\Tests;

use App\Packages\Student\Facade\StudentFacade;
use App\Packages\Student\Model\Student;
use App\Packages\Student\Service\StudentService;
use Exception;
use JetBrains\PhpStorm\NoReturn;
use Tests\TestCase;

class StudentFacadeTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testEnrollStudentShouldReturnStringExpected()
    {
        $studentServiceMock = $this->createMock(StudentService::class);
        $expected = 'Student Flávio registered!';
        $studentServiceMock->method('enrollStudent')->willReturn($expected);

        /** @var StudentFacade $studentFacade */
        $studentFacade = app(StudentFacade::class);
        $result = $studentFacade->enrollStudent('Flávio');

        $this->assertSame($expected, $result);
    }

    #[NoReturn] public function testGetStudentShouldReturnTheStudentObject()
    {
        $student = new Student('João');
        $studentServiceMock = $this->createMock(StudentService::class);
        $studentServiceMock->method('getStudent')->willReturn($student);

        $studentFacade = new StudentFacade($studentServiceMock);
        $result = $studentFacade->getStudent($student->getId());

        $this->assertSame($result, $student);
    }
}
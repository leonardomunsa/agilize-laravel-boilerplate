<?php

namespace App\Packages\Exam\Tests;

use App\Packages\Exam\Model\Subject;
use App\Packages\Exam\Repository\QuestionRepository;
use App\Packages\Exam\Repository\SubjectRepository;
use App\Packages\Exam\Service\QuestionService;
use App\Packages\Exam\Service\SubjectService;
use Exception;
use Tests\TestCase;

class QuestionServiceTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testEnrollQuestionShouldReturnTheExactString()
    {
        $subject = new Subject('Javascript');
        $subjectRepositoryMock = $this->createMock(SubjectRepository::class);
        $subjectRepositoryMock->method('findSubjectById')->willReturn($subject);
        $this->app->bind(SubjectRepository::class, fn() => $subjectRepositoryMock);

        /** @var QuestionService $questionService */
        $questionService = app(QuestionService::class);
        $result = $questionService->enrollQuestion('Quando o Javascript foi criado?', $subject->getId());

        $this->assertSame('Question registered!', $result);
    }

    /**
     * @throws Exception
     */
    public function testEnrollQuestionShouldThrowAnException()
    {
        $subject = new Subject('Java');
        $subjectRepositoryMock = $this->createMock(SubjectRepository::class);
        $subjectRepositoryMock->method('findSubjectById')->willReturn($subject);
        $this->app->bind(SubjectRepository::class, fn() => $subjectRepositoryMock);

        $this->expectExceptionMessage('The question should have at least ten characters');

        /** @var QuestionService $questionService */
        $questionService = app(QuestionService::class);
        $questionService->enrollQuestion('', $subject->getId());
    }

    public function testGetQuestionsShouldReturnAnArray()
    {
        $questionRepositoryMock = $this->createMock(QuestionRepository::class);
        $questionRepositoryMock->method('findAllQuestions')->willReturn([]);

        /** @var QuestionService $questionService */
        $questionService = app(QuestionService::class);
        $result = $questionService->getQuestions();

        $this->assertIsArray($result);
    }
}
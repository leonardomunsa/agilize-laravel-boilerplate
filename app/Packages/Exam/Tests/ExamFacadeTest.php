<?php

namespace App\Packages\Exam\Tests;

use App\Packages\Exam\Facade\ExamFacade;
use App\Packages\Exam\Model\Exam;
use App\Packages\Exam\Model\Question;
use App\Packages\Exam\Model\Subject;
use App\Packages\Exam\Repository\QuestionRepository;
use App\Packages\Exam\Repository\SubjectRepository;
use App\Packages\Exam\Service\ExamService;
use App\Packages\Exam\Service\QuestionService;
use App\Packages\Exam\Service\SubjectService;
use App\Packages\Student\Model\Student;
use Exception;

class ExamFacadeTest extends \Tests\TestCase
{

    public function testEnrollSubjectShouldReturnStringExpected()
    {
        $string = 'Subject Biologia registered!';
        $subjectServiceMock = $this->createMock(SubjectService::class);
        $subjectServiceMock->method('enrollSubject')->willReturn($string);

        /** @var ExamFacade $examFacade */
        $examFacade = app(ExamFacade::class);
        $result = $examFacade->enrollSubject('Biologia');

        $this->assertSame($string, $result);
    }

    public function testGetSubjectsShouldReturnArray()
    {
        $subjectServiceMock = $this->createMock(SubjectService::class);
        $subjectServiceMock->method('getSubjects')->willReturn([]);

        /** @var ExamFacade $examFacade */
        $examFacade = app(ExamFacade::class);
        $result = $examFacade->getSubjects();

        $this->assertIsArray($result);
    }

    /**
     * @throws Exception
     */
    public function testEnrollQuestionShouldReturnStringExpected()
    {
        $subject = new Subject('Português');

        $subjectRepositoryMock = $this->createMock(SubjectRepository::class);
        $subjectRepositoryMock->method('findSubjectById')->willReturn($subject);
        $this->app->bind(SubjectRepository::class, fn() => $subjectRepositoryMock);

        $string = 'Question registered!';
        $questionMock = $this->createMock(QuestionService::class);
        $questionMock->method('enrollQuestion')->willReturn($string);

        /** @var ExamFacade $examFacade */
        $examFacade = app(ExamFacade::class);
        $result = $examFacade->enrollQuestion('Sabia o sabiá sabia assobiar?', $subject->getId());

        $this->assertSame($string, $result);
    }

    /**
     * @throws Exception
     */
    public function testEnrollQuestionShouldThrowAnException()
    {
        $this->expectExceptionMessage('The question should have at least ten characters');

        /** @var ExamFacade $examFacade */
        $examFacade = app(ExamFacade::class);
        $examFacade->enrollQuestion('a', '2312312312');
    }

    public function testGetQuestionsShouldReturnArray()
    {
        $questionServiceMock = $this->createMock(QuestionService::class);
        $questionServiceMock->method('getQuestions')->willReturn([]);

        /** @var ExamFacade $examFacade */
        $examFacade = app(ExamFacade::class);
        $result = $examFacade->getQuestions();

        $this->assertIsArray($result);
    }

    /**
     * @throws Exception
     */
    public function testEnrollOptionsShouldReturnStringExpected()
    {
        $string = 'The options are registered!';

        $subject = new Subject('Português');
        $question = new Question('abcdefghijklmnopqrstuvwxyz', $subject);

        $questionRepositoryMock = $this->createMock(QuestionRepository::class);
        $questionRepositoryMock->method('findQuestionById')->willReturn($question);
        $this->app->bind(QuestionRepository::class, fn () => $questionRepositoryMock);

        $options = [
            [
                'content' => 'aaaaaaaaaaaaaaa',
                'correct' => true
            ],
            [
                'content' => 'bbbbbbbbbbbbbbbbb',
                'correct' => false
            ]
        ];

        /** @var ExamFacade $examFacade */
        $examFacade = app(ExamFacade::class);
        $result = $examFacade->enrollOptions($options, $question->getId());

        $this->assertSame($string, $result);
    }

    public function testStartExamShouldReturnAnInstanceOfExam()
    {
        $subject = new Subject('Português');
        $student = new Student('Andrea');
        $exam = new Exam(12, 'open', $subject, $student);

        $subjectRepositoryMock = $this->createMock(SubjectRepository::class);
        $subjectRepositoryMock->method('findSubjectById')->willReturn($subject);
        $this->app->bind(SubjectRepository::class, fn () => $subjectRepositoryMock);

        $examServiceMock = $this->createMock(ExamService::class);
        $examServiceMock->method('startExam')->willReturn($exam);

        /** @var ExamFacade $examFacade */
        $examFacade = app(ExamFacade::class);
        $result = $examFacade->startExam($student, $subject->getId());

        $this->assertInstanceOf(Exam::class, $result);
    }
}
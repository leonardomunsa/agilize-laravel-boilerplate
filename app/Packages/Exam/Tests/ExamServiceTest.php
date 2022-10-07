<?php

namespace App\Packages\Exam\Tests;

use App\Packages\Exam\Model\Exam;
use App\Packages\Exam\Model\Question;
use App\Packages\Exam\Model\Subject;
use App\Packages\Exam\Repository\ExamRepository;
use App\Packages\Exam\Repository\QuestionRepository;
use App\Packages\Exam\Repository\SubjectRepository;
use App\Packages\Exam\Seed\QuestionOptionSeed;
use App\Packages\Exam\Seed\SubjectSeed;
use App\Packages\Exam\Service\ExamService;
use App\Packages\Student\Model\Student;
use Carbon\Carbon;
use Doctrine\ORM\EntityManager;
use Exception;
use Tests\TestCase;

class ExamServiceTest extends TestCase
{
    public function testStartExamShouldReturnTheInstanceOfAnExam()
    {
        $this->seed(SubjectSeed::class);
        $this->seed(QuestionOptionSeed::class);

        $student = new Student('James');

        $examRepositoryMock = $this->createMock(ExamRepository::class);

        $questionRepository = app(QuestionRepository::class);

        /** @var Subject $subject */
        $subjectRepository = app(SubjectRepository::class);
        $subject = $subjectRepository->findOneBy(['name' => 'Matemática']);

        $examService = new ExamService($examRepositoryMock, $subjectRepository, $questionRepository);
        $result = $examService->startExam($student, $subject->getId());

        $this->assertInstanceOf(Exam::class, $result);
    }

    /**
     * @throws Exception
     */
    public function testFinishExamShouldReturnTheExactGrade()
    {
        $subject = new Subject('Português');
        $student = new Student('Andrea');
        $exam = new Exam(5, 'open', $subject, $student);

        $examRepositoryMock = $this->createMock(ExamRepository::class);
        $examRepositoryMock->method('getNumberOfRightAnswers')->willReturn([0 => [1 => 5]]);
        $this->app->bind(ExamRepository::class, fn () => $examRepositoryMock);

        /** @var ExamService $examService */
        $examService = app(ExamService::class);
        $result = $examService->finishExam($exam, []);

        $this->assertSame(10.0, $result);
    }
}
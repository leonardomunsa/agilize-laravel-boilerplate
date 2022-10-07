<?php

namespace App\Packages\Exam\Model;

use App\Packages\Student\Model\Student;
use Carbon\Carbon;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Illuminate\Support\Str;

/**
 * @ORM\Entity
 * @ORM\Table(name="exam")
 */
class Exam
{
    const BASE_GRADE = 10;

    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     */
    protected string $id;

    /**
     * @ORM\Column(type="integer")
     */
    protected int $questionsAmount;

    /**
     * @ORM\Column(type="string", length="24")
     */
    protected string $status;

    /**
     * @ORM\Column(type="datetime")
     */
    protected \DateTime $startTime;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected \DateTime $endTime;

    /**
     * @ORM\ManyToOne(targetEntity="Subject", cascade={"persist"})
     */
    protected Subject $subject;

    /**
     * @ORM\ManyToOne(targetEntity="App\Packages\Student\Model\Student", inversedBy="id", cascade={"persist"})
     */
    protected Student $student;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    protected null|float $grade;

    /**
     * @ORM\OneToMany(targetEntity="QuestionRegister", mappedBy="exam", cascade={"all"}, orphanRemoval=true)
     */
    protected Collection $questions;

    public function __construct(int $questionsAmount, string $status, Subject $subject, Student $student, null|float $grade = null)
    {
        $this->id = Str::uuid()->toString();
        $this->questionsAmount = $questionsAmount;
        $this->status = $status;
        $this->subject = $subject;
        $this->startTime = Carbon::now();
        $this->student = $student;
        $this->grade = $grade;
        $this->questions = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getQuestionsAmount(): int
    {
        return $this->questionsAmount;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return Subject
     */
    public function getSubject(): Subject
    {
        return $this->subject;
    }

    /**
     * @return \DateTime
     */
    public function getStartTime(): \DateTime
    {
        return $this->startTime;
    }

    /**
     * @return \DateTime
     */
    public function getEndTime(): \DateTime|Carbon
    {
        return $this->endTime;
    }

    /**
     * @return Student
     */
    public function getStudent(): Student
    {
        return $this->student;
    }

    /**
     * @return float
     */
    public function getGrade($numberOfRightAnswers): float
    {
        $valueForQuestion = self::BASE_GRADE / $this->questionsAmount;
        $this->grade = round($valueForQuestion * $numberOfRightAnswers, 2);
        return $this->grade;
    }

    /**
     * @return ArrayCollection|Collection
     */
    public function getQuestions(): ArrayCollection|Collection
    {
        return $this->questions;
    }

    public function addQuestion(QuestionRegister $questionRegister): void
    {
        $this->questions->add($questionRegister);
    }

    public function closeStatus(): void
    {
        $this->status = 'closed';
    }

    public function endTime(): void
    {
        $this->endTime = Carbon::now();
    }
}
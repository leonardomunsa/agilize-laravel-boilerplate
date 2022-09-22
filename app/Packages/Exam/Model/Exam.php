<?php

namespace App\Packages\Exam\Model;

use App\Packages\Student\Model\Student;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Illuminate\Support\Str;

/**
 * @ORM\Entity
 * @ORM\Table(name="exam")
 */
class Exam
{
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
     * @ORM\ManyToOne(targetEntity="Subject")
     */
    protected Subject $subject;

    /**
     * @ORM\ManyToOne(targetEntity="App\Packages\Student\Model\Student", inversedBy="id")
     */
    protected Student $student;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    protected float $grade;

    public function __construct(int $questionsAmount, string $status, Subject $subject, \DateTime $startTime, Student $student, float $grade = null)
    {
        $this->id = Str::uuid()->toString();
        $this->questionsAmount = $questionsAmount;
        $this->status = $status;
        $this->subject = $subject;
        $this->startTime = $startTime;
        $this->student = $student;
        $this->grade = $grade;
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
    public function getEndTime(): \DateTime
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
    public function getGrade(): float
    {
        return $this->grade;
    }

    /**
     * @return ArrayCollection|Collection
     */
    public function getAnswers(): ArrayCollection|Collection
    {
        return $this->answers;
    }
}
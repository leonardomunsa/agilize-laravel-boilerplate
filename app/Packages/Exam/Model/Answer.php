<?php

namespace App\Packages\Exam\Model;

use Doctrine\ORM\Mapping as ORM;
use Illuminate\Support\Str;

/**
 * @ORM\Entity
 * @ORM\Table(name="answer")
 */
class Answer
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     */
    protected string $id;

    /**
     * @ORM\ManyToOne(targetEntity="Question")
     */
    protected Question $question;

    /**
     * @ORM\ManyToOne(targetEntity="Exam")
     */
    protected Exam $exam;

    /**
     * @ORM\ManyToOne(targetEntity="Option")
     */
    protected Option $pickedOption;

    public function __construct(Question $question, Exam $exam, Option $pickedOption)
    {
        $this->id = Str::uuid()->toString();
        $this->question = $question;
        $this->exam = $exam;
        $this->pickedOption = $pickedOption;
    }


    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return Question
     */
    public function getQuestionId(): Question
    {
        return $this->question;
    }

    /**
     * @return Exam
     */
    public function getExamId(): Exam
    {
        return $this->exam;
    }

    /**
     * @return Option
     */
    public function getPickedOption(): Option
    {
        return $this->pickedOption;
    }
}
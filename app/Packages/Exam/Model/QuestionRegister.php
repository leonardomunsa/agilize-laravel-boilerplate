<?php

namespace App\Packages\Exam\Model;

use Doctrine\ORM\Mapping as ORM;
use Illuminate\Support\Str;

/**
 * @ORM\Entity
 * @ORM\Table(name="question_register")
 */
class QuestionRegister
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     */
    protected string $id;

    /**
     * @ORM\ManyToOne(targetEntity="Exam")
     */
    protected Exam $exam;

    /**
     * @ORM\Id
     * @ORM\Column(type="string")
     */
    protected string $content;

    public function __construct(string $content, Exam $exam)
    {
        $this->id = Str::uuid()->toString();
        $this->content = $content;
        $this->exam = $exam;
    }


    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }


    /**
     * @return Exam
     */
    public function getExamId(): Exam
    {
        return $this->exam;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }
}
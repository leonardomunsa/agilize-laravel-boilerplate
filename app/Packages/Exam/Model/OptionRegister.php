<?php

namespace App\Packages\Exam\Model;

use Illuminate\Support\Str;

class OptionRegister
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     */
    protected string $id;

    /**
     * @ORM\Id
     * @ORM\Column(type="string")
     */
    protected string $content;

    /**
     * @ORM\Column(type="boolean")
     */
    protected bool $correct;

    /**
     * @ORM\Column(type="boolean")
     */
    protected bool $picked;

    /**
     * @ORM\ManyToOne(targetEntity="Question")
     */
    protected Question $question;

    public function __construct(string $content, bool $correct, bool $picked, Question $question)
    {
        $this->id = Str::uuid()->toString();
        $this->content = $content;
        $this->correct = $correct;
        $this->picked = $picked;
        $this->question = $question;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return bool
     */
    public function isPicked(): bool
    {
        return $this->picked;
    }

    /**
     * @return Question
     */
    public function getQuestion(): Question
    {
        return $this->question;
    }

    /**
     * @return bool
     */
    public function isCorrect(): bool
    {
        return $this->correct;
    }


}
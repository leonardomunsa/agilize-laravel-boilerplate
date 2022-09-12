<?php

namespace App\Packages\Exam\Model;

use Doctrine\ORM\Mapping as ORM;
use Illuminate\Support\Str;

/**
 * @ORM\Entity
 * @ORM\Table(name="option")
 */
class Option
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     */
    protected string $id;

    /**
     * @ORM\Column(type="string")
     */
    protected string $content;

    /**
     * @ORM\Column(type="boolean")
     */
    protected bool $correct;

    /**
     * @ORM\ManyToOne(targetEntity="Question")
     */
    protected Question $question;

    public function __construct(string $content, bool $correct, Question $question)
    {
        $this->id = Str::uuid()->toString();
        $this->content = $content;
        $this->correct = $correct;
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
    public function isCorrect(): bool
    {
        return $this->correct;
    }
}
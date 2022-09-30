<?php

namespace App\Packages\Exam\Model;

use Illuminate\Support\Str;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="option_register")
 */
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
     * @ORM\ManyToOne(targetEntity="QuestionRegister", inversedBy="options")
     */
    protected QuestionRegister $questionRegister;

    public function __construct(string $content, bool $correct, QuestionRegister $questionRegister, bool $picked = false)
    {
        $this->id = Str::uuid()->toString();
        $this->content = $content;
        $this->correct = $correct;
        $this->questionRegister = $questionRegister;
        $this->picked = $picked;
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
     * @return bool
     */
    public function isCorrect(): bool
    {
        return $this->correct;
    }
}
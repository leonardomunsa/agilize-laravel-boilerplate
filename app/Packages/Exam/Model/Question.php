<?php

namespace App\Packages\Exam\Model;

use Doctrine\ORM\Mapping as ORM;
use Illuminate\Support\Str;

/**
 * @ORM\Entity
 * @ORM\Table(name="question")
 */
class Question
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
     * @ORM\ManyToOne(targetEntity="Subject")
     */
    protected Subject $subject;

    public function __construct(string $content, Subject $subject)
    {
        $this->id = Str::uuid()->toString();
        $this->content = $content;
        $this->subject = $subject;
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
    public function getQuestion(): string
    {
        return $this->content;
    }
}
<?php

namespace App\Packages\Exam\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\Column(type="string")
     */
    protected string $content;

    /**
     * @ORM\ManyToOne(targetEntity="Subject")
     */
    protected Subject $subject;

    /**
     * @ORM\OneToMany(targetEntity="Option", mappedBy="question", cascade={"all"}, orphanRemoval=true)
     */
    protected Collection $options;

    public function __construct(string $content, Subject $subject)
    {
        $this->id = Str::uuid()->toString();
        $this->content = $content;
        $this->subject = $subject;
        $this->options = new ArrayCollection();
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

    /**
     * @return ArrayCollection|Collection
     */
    public function getOptions(): ArrayCollection|Collection
    {
        return $this->options;
    }

    public function addOption(Option $option): void
    {
        $this->options->add($option);
    }
}
<?php

namespace App\Packages\Exam\Model;

use Doctrine\ORM\Mapping as ORM;
use Illuminate\Support\Str;

/**
 * @ORM\Entity
 * @ORM\Table(name="subject")
 */
class Subject
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     */
    protected string $id;

    /**
     * @ORM\Column(type="string", length=246)
     */
    protected string $name;

    public function __construct(string $name)
    {
        $this->id = Str::uuid()->toString();
        $this->name = $name;
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
    public function getName(): string
    {
        return $this->name;
    }
}
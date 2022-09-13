<?php

namespace App\Packages\Student\Model;

use Doctrine\ORM\Mapping as ORM;
use Illuminate\Support\Str;

/**
 * @ORM\Entity
 * @ORM\Table(name="student")
 */
class Student
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
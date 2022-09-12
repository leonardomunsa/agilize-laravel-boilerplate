<?php

namespace App\Packages\Base;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;

class AbstractRepository extends EntityRepository
{
    protected string $entityName;

    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, new ClassMetadata($this->entityName));
    }
}

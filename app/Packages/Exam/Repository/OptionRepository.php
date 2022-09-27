<?php

namespace App\Packages\Exam\Repository;

use App\Packages\Base\AbstractRepository;
use App\Packages\Exam\Model\Option;
use LaravelDoctrine\ORM\Facades\EntityManager;

class OptionRepository extends AbstractRepository
{
    public string $entityName = Option::class;

    public function addOption(Option $option)
    {
        EntityManager::persist($option);
    }
}
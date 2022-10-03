<?php

namespace App\Packages\Exam\Repository;

use App\Packages\Base\AbstractRepository;
use App\Packages\Exam\Model\OptionRegister;
use LaravelDoctrine\ORM\Facades\EntityManager;

class OptionRegisterRepository extends AbstractRepository
{
    public string $entityName = OptionRegister::class;
}
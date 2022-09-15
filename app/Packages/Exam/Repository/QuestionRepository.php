<?php

namespace App\Packages\Exam\Repository;

use App\Packages\Base\AbstractRepository;
use App\Packages\Exam\Model\Question;
use LaravelDoctrine\ORM\Facades\EntityManager;

class QuestionRepository extends AbstractRepository
{
    public string $entityName = Question::class;

    public function addQuestion(Question $question)
    {
        EntityManager::persist($question);
    }
}
<?php

namespace App\Packages\Exam\Repository;

use App\Packages\Base\AbstractRepository;
use App\Packages\Exam\Model\Option;
use App\Packages\Exam\Model\Question;
use Doctrine\ORM\Query\Expr\Join;
use LaravelDoctrine\ORM\Facades\EntityManager;

class QuestionRepository extends AbstractRepository
{
    public string $entityName = Question::class;

    public function addQuestion(Question $question)
    {
        EntityManager::persist($question);
    }

    public function findQuestionById(string $questionId)
    {
        return $this->findOneBy(['id' => $questionId]);
    }

    public function getAmountOfQuestions($subjectId, $limit)
    {
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();
        return $queryBuilder
            ->select('q.content, o.content')
            ->from($this->entityName, 'q')
            ->where('q.subject = :subject')
            ->setParameter('subject', $subjectId)
            ->orderBy('RANDOM()')
            ->setMaxResults($limit);
    }
}
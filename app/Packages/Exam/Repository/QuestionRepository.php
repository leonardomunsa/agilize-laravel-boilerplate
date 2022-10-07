<?php

namespace App\Packages\Exam\Repository;

use App\Packages\Base\AbstractRepository;
use App\Packages\Exam\Model\Option;
use App\Packages\Exam\Model\Question;
use App\Packages\Exam\Model\Subject;
use Doctrine\ORM\NonUniqueResultException;
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

    public function findAllQuestions(): array
    {
        return $this->findAll();
    }

    public function getAmountOfQuestions($limit, $subject)
    {
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();
        return $queryBuilder
            ->select('q')
            ->from($this->entityName, 'q')
            ->where('q.subject = :subject')
            ->setParameter('subject', $subject)
            ->orderBy('RANDOM()')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }
}
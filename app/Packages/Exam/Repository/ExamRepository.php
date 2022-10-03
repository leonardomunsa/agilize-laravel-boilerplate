<?php

namespace App\Packages\Exam\Repository;

use App\Packages\Base\AbstractRepository;
use App\Packages\Exam\Model\Exam;
use App\Packages\Exam\Model\OptionRegister;
use App\Packages\Exam\Model\QuestionRegister;
use Doctrine\ORM\Query\Expr\Join;
use LaravelDoctrine\ORM\Facades\EntityManager;

class ExamRepository extends AbstractRepository
{
    public string $entityName = Exam::class;

    public function startExam(Exam $exam)
    {
        EntityManager::persist($exam);
    }

    public function createQuestionsRegister(QuestionRegister $questionRegister)
    {
        EntityManager::persist($questionRegister);
    }

    public function createOptionsRegister(OptionRegister $optionRegister)
    {
        EntityManager::persist($optionRegister);
    }

    public function updateExam(Exam $exam)
    {
        EntityManager::merge($exam);
        EntityManager::flush();
    }

    public function findExamById(string $examId)
    {
        return $this->findOneBy(['id' => $examId]);
    }

    public function updatePickedOptions(string $optionId)
    {
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();
        return $queryBuilder
            ->update(OptionRegister::class, 'o')
            ->set('o.picked', ':boolean')
            ->where('o.id = :id')
            ->setParameter('id', $optionId)
            ->setParameter('boolean', true)
            ->getQuery()
            ->execute();
    }

    public function getNumberOfRightAnswers(Exam $exam)
    {
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();
        return $queryBuilder
            ->select('count(q.id)')
            ->from(QuestionRegister::class, 'q')
            ->join(OptionRegister::class, 'o', Join::WITH, 'q.id = o.questionRegister')
            ->where('q.exam = :examId')
            ->andWhere('o.correct = :boolean')
            ->andWhere('o.picked = :boolean')
            ->setParameter('examId', $exam)
            ->setParameter('boolean', true)
            ->getQuery()
            ->getResult();
    }
}
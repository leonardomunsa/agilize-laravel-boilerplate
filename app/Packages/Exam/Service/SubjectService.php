<?php

namespace App\Packages\Exam\Service;

use App\Packages\Exam\Model\Subject;
use App\Packages\Exam\Repository\SubjectRepository;

class SubjectService
{
    public function __construct(
        protected SubjectRepository $subjectRepository
    )
    {
    }

    public function enrollSubject(string $name): string
    {
            $subject = new Subject($name);
            $this->subjectRepository->addSubject($subject);
            return 'Subject ' . $name . ' registered!';
    }

    public function getSubjectByName(string $name): ?Subject
    {
        return $this->subjectRepository->findSubjectByName($name);
    }
}
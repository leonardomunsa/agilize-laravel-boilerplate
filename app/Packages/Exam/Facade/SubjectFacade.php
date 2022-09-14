<?php

namespace App\Packages\Exam\Facade;

use App\Packages\Exam\Service\SubjectService;

class SubjectFacade
{
    public function __construct(
        protected SubjectService $subjectService
    )
    {
    }

    public function enrollSubject(string $name): string
    {
        return $this->subjectService->enrollSubject($name);
    }
}
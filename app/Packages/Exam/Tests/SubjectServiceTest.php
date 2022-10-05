<?php

namespace App\Packages\Exam\Tests;

use App\Packages\Exam\Model\Subject;
use App\Packages\Exam\Repository\SubjectRepository;
use App\Packages\Exam\Service\SubjectService;
use Tests\TestCase;

class SubjectServiceTest extends TestCase
{
    public function testItShouldReturnTheExactString()
    {
        /** @var SubjectService $subjectService */
        $subjectService = app(SubjectService::class);
        $result = 'Subject Geografia registered!';

        $subject = $subjectService->enrollSubject('Geografia');

        $this->assertSame($subject, $result);
    }
}
<?php

namespace App\Packages\Exam\Seed;

use App\Packages\Exam\Model\Subject;
use Illuminate\Database\Seeder;
use LaravelDoctrine\ORM\Facades\EntityManager;

class SubjectSeed extends Seeder
{
    public function run(): void
    {
        $subjectSeed = [
            [
                'name' => 'Matemática'
            ],
            [
                'name' => 'História'
            ]
        ];

        foreach ($subjectSeed as $subject) {
            EntityManager::persist(new Subject($subject['name']));
            EntityManager::flush();
        }
    }
}
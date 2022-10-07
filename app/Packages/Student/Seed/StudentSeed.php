<?php

namespace App\Packages\Student\Seed;

use App\Packages\Student\Model\Student;
use Illuminate\Database\Seeder;
use LaravelDoctrine\ORM\Facades\EntityManager;

class StudentSeed extends Seeder
{
    public function run(): void
    {
        $studentSeed = [
            [
                'name' => 'James'
            ],
            [
                'name' => 'Big'
            ]
        ];

        foreach ($studentSeed as $student) {
            EntityManager::persist(new Student($student['name']));
            EntityManager::flush();
        }
    }
}
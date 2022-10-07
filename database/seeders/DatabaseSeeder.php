<?php

namespace Database\Seeders;

use App\Packages\Exam\Seed\QuestionOptionSeed;
use App\Packages\Exam\Seed\SubjectSeed;
use App\Packages\Student\Seed\StudentSeed;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call([
            StudentSeed::class,
            SubjectSeed::class,
            QuestionOptionSeed::class
        ]);
    }
}

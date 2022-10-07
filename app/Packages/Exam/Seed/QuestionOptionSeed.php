<?php

namespace App\Packages\Exam\Seed;

use App\Packages\Exam\Model\Option;
use App\Packages\Exam\Model\Question;
use App\Packages\Exam\Model\Subject;
use Illuminate\Database\Seeder;
use LaravelDoctrine\ORM\Facades\EntityManager;

class QuestionOptionSeed extends Seeder
{
    public function run(): void
    {
        $content = file_get_contents(base_path('app/Packages/Exam/Seed/questionOptions.json'));
        $data = json_decode($content);

        foreach ($data->questions as $questionSeed) {
            $subject = EntityManager::getRepository(Subject::class)->findOneBy(['name' => $questionSeed->subject]);
            $question = new Question($questionSeed->content, $subject);
            $options = $questionSeed->options;
            foreach ($options as $optionSeed) {
                $option = new Option($optionSeed->content, $optionSeed->correct, $question);
                $question->addOption($option);
            }
            EntityManager::persist($question);
            EntityManager::flush();
        }
    }
}
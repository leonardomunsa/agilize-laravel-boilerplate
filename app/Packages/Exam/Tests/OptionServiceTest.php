<?php

namespace App\Packages\Exam\Tests;

use App\Packages\Exam\Model\Question;
use App\Packages\Exam\Model\Subject;
use App\Packages\Exam\Repository\OptionRepository;
use App\Packages\Exam\Repository\QuestionRepository;
use App\Packages\Exam\Repository\SubjectRepository;
use App\Packages\Exam\Service\OptionService;
use App\Packages\Exam\Service\QuestionService;
use Exception;
use Tests\TestCase;

class OptionServiceTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testEnrollOptionShouldReturnTheExactString()
    {
        $subject = new Subject('PHP');
        $question = new Question('Qual a versão mais usada do PHP?', $subject);

        $questionRepositoryMock = $this->createMock(QuestionRepository::class);
        $questionRepositoryMock->method('findQuestionById')->willReturn($question);
        $optionRepositoryMock = $this->createMock(OptionRepository::class);
        $optionService = new OptionService($questionRepositoryMock, $optionRepositoryMock);

        $options = [
            [
                "content" => "1.0",
                "correct" => false
            ],
            [
                "content" => "8.0",
                "correct" => false
            ],
            [
                "content" => "7.3",
                "correct" => false
            ],
            [
                "content" => "5.6",
                "correct" => true
            ],
        ];

        $result = $optionService->enrollOptions($options, $question->getId());

        $this->assertSame('The options are registered!', $result);
    }

    public function dataProvider(): array
    {
        return [
            'empty options' => [
                'options' => [
                    [
                        "content" => "",
                        "correct" => false
                    ],
                    [
                        "content" => "Pedro Alvares Cabral",
                        "correct" => true
                    ],
                    [
                        "content" => "Jose",
                        "correct" => false
                    ],
                    [
                        "content" => "Eu",
                        "correct" => false
                    ],
                ]
            ],
            'two equal options' => [
                'options' => [
                    [
                        "content" => "Pedro Alvares Cabral",
                        "correct" => true
                    ],
                    [
                        "content" => "Ninguem",
                        "correct" => false
                    ],
                    [
                        "content" => "Ninguem",
                        "correct" => false
                    ],
                    [
                        "content" => "Cristovao Colombo",
                        "correct" => false
                    ],
                ]
            ],
            'more than one correct option' => [
                'options' => [
                    [
                        "content" => "Cristovao Colombo",
                        "correct" => true
                    ],
                    [
                        "content" => "Pedro Alvares Cabral",
                        "correct" => true
                    ],
                    [
                        "content" => "Bolsonaro",
                        "correct" => false
                    ],
                    [
                        "content" => "Lula",
                        "correct" => false
                    ],
                ]
            ]
        ];
    }

    /**
     * @dataProvider dataProvider
     * @throws Exception
     */
    public function testEnrollOptionShouldThrowAnException(
        $options
    )
    {
        $subject = new Subject('História');
        $question = new Question('Qual navegador português fez seu país colonizar o Brasil?', $subject);

        $questionRepositoryMock = $this->createMock(QuestionRepository::class);
        $questionRepositoryMock->method('findQuestionById')->willReturn($question);
        $optionRepositoryMock = $this->createMock(OptionRepository::class);
        $optionService = new OptionService($questionRepositoryMock, $optionRepositoryMock);

        $this->expectExceptionMessage('The options are either empty, equal to one another or there is more than one correct option');

        $optionService->enrollOptions($options, $question->getId());
    }
}
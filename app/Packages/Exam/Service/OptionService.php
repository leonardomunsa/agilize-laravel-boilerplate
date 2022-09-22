<?php

namespace App\Packages\Exam\Service;

use App\Packages\Exam\Model\Option;
use App\Packages\Exam\Model\Question;
use App\Packages\Exam\Repository\OptionRepository;
use App\Packages\Exam\Repository\QuestionRepository;

class OptionService
{
    const MIN_LENGTH_OPTION = 1;

    public function __construct(
        protected QuestionRepository $questionRepository,
        protected OptionRepository $optionRepository,
    )
    {
    }

    public function enrollOptions(array $options, string $questionId): string
    {
        $question = $this->questionRepository->findQuestionById($questionId);
        if (!($this->checkIfOptionsAreEmpty($options) && $this->checkIfAtLeastTwoOptionsAreEqual($options))) {
            foreach ($options as $option) {
                $newOption = new Option($option['content'], $option['correct'], $question);
                $this->optionRepository->addOption($newOption);
                $question->addOption($newOption);
            }
            return 'The options are registered';
        }
        return 'The options are either empty or equal to one another';
    }

    public function checkIfOptionsAreEmpty(array $options): bool
    {
        for ($i = 0; $i <= count($options); $i++) {
            $content = $options[$i]['content'];
            if (!(strlen($content < self::MIN_LENGTH_OPTION))) {
                return true;
            };
        }
        return false;
    }

    public function checkIfAtLeastTwoOptionsAreEqual(array $options): bool
    {
        return count(array_unique($options, SORT_REGULAR)) === count($options) - 1;
    }
}
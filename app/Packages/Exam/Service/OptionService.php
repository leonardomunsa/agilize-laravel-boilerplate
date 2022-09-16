<?php

namespace App\Packages\Exam\Service;

use App\Packages\Exam\Model\Question;
use App\Packages\Exam\Repository\QuestionRepository;

class OptionService
{
    const MIN_LENGTH_OPTION = 1;

    public function __construct(
        protected QuestionRepository $questionRepository,
        protected OptionRepository $optionRepository
    )
    {
    }

    public function enrollQuestion(array $options, string $subject): string
    {
        if (!($this->checkIfOptionsAreEmpty($options) && $this->checkIfAtLeastTwoOptionsAreEqual($options))) {

        }
    }

    public function checkIfOptionsAreEmpty(array $options): bool
    {
        foreach ($options as $option) {
            if (!(strlen($option) < self::MIN_LENGTH_OPTION)) {
                return true;
            };
        }
        return false;
    }

    public function checkIfAtLeastTwoOptionsAreEqual(array $options): bool
    {
        return count(array_unique($options)) === count($options) - 1;
    }
}
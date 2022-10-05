<?php

namespace App\Packages\Exam\Service;

use App\Packages\Exam\Model\Option;
use App\Packages\Exam\Model\Question;
use App\Packages\Exam\Repository\OptionRepository;
use App\Packages\Exam\Repository\QuestionRepository;
use Exception;

class OptionService
{
    const MIN_LENGTH_OPTION = 1;

    public function __construct(
        protected QuestionRepository $questionRepository,
        protected OptionRepository $optionRepository,
    )
    {
    }

    /**
     * @throws Exception
     */
    public function enrollOptions(array $options, string $questionId): string
    {
        $question = $this->questionRepository->findQuestionById($questionId);
        if ((!($this->checkIfOptionsAreEmptyOrThereMoreThanOneCorrect($options)) && !($this->checkIfAtLeastTwoOptionsAreEqual($options)))) {
            foreach ($options as $option) {
                $newOption = new Option($option['content'], $option['correct'], $question);
                $this->optionRepository->addOption($newOption);
                $question->addOption($newOption);
            }
            return 'The options are registered!';
        }
        throw new Exception('The options are either empty, equal to one another or there is more than one correct option', 1664998229);
    }

    private function checkIfOptionsAreEmptyOrThereMoreThanOneCorrect(array $options): bool
    {
        $numberOfCorrectOptions = 0;
        for ($i = 0; $i < count($options); $i++) {
            $content = $options[$i]['content'];
            if (strlen($content < self::MIN_LENGTH_OPTION)) {
                return true;
            };
            if ($options[$i]['correct'] === true) {
                $numberOfCorrectOptions += 1;
            }
        }
        if ($numberOfCorrectOptions > 1) {
            return true;
        }
        return false;
    }

    private function checkIfAtLeastTwoOptionsAreEqual(array $options): bool
    {
        return count(array_unique($options, SORT_REGULAR)) < count($options);
    }
}
<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Steps\Domain\Quiz;

use function Lambdish\Phunctional\map;

final class QuizStepQuestion
{
    private $question;
    private $answers;

    public function __construct(string $question, QuizStepAnswer ...$answers)
    {
        $this->question = $question;
        $this->answers  = $answers;
    }

    public function toValues(): array
    {
        return [
            'question' => $this->question(),
            'answers'  => map($this->answerToValues(), $this->answers()),
        ];
    }

    public static function fromValues(array $values): self
    {
        return new self($values['question'], ...map(self::valuesToAnswer(), $values['answers']));
    }

    public function question(): string
    {
        return $this->question;
    }

    /** @return QuizStepAnswer[] */
    public function answers(): array
    {
        return $this->answers;
    }

    private function answerToValues(): callable
    {
        return static function (QuizStepAnswer $answer): array {
            return $answer->toValues();
        };
    }

    private static function valuesToAnswer(): callable
    {
        return static function (array $values): QuizStepAnswer {
            return QuizStepAnswer::fromValues($values);
        };
    }
}

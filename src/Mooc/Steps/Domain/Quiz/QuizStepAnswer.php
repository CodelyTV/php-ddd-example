<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Steps\Domain\Quiz;

final class QuizStepAnswer
{
    private $answer;
    private $isCorrect;

    public function __construct(string $answer, bool $isCorrect)
    {
        $this->answer    = $answer;
        $this->isCorrect = $isCorrect;
    }

    public function toValues(): array
    {
        return [
            'answer'     => $this->answer(),
            'is_correct' => $this->isCorrect(),
        ];
    }

    public static function fromValues(array $values): self
    {
        return new self($values['answer'], $values['is_correct']);
    }

    public function answer(): string
    {
        return $this->answer;
    }

    public function isCorrect(): bool
    {
        return $this->isCorrect;
    }
}

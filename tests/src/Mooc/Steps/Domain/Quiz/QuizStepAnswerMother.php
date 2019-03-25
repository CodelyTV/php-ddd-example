<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Steps\Domain\Quiz;

use CodelyTv\Mooc\Steps\Domain\Quiz\QuizStepAnswer;
use CodelyTv\Test\Shared\Domain\BoolMother;
use CodelyTv\Test\Shared\Domain\TextMother;

final class QuizStepAnswerMother
{
    public static function create(string $answer, bool $isCorrect): QuizStepAnswer
    {
        return new QuizStepAnswer($answer, $isCorrect);
    }

    public static function creator(): callable
    {
        return static function (): QuizStepAnswer {
            return QuizStepAnswerMother::random();
        };
    }

    public static function random(): QuizStepAnswer
    {
        return self::create(TextMother::short(), BoolMother::random());
    }
}

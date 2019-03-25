<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Steps\Domain\Quiz;

use CodelyTv\Mooc\Steps\Domain\Quiz\QuizStepAnswer;
use CodelyTv\Mooc\Steps\Domain\Quiz\QuizStepQuestion;
use CodelyTv\Test\Shared\Domain\RepeatMother;
use CodelyTv\Test\Shared\Domain\TextMother;

final class QuizStepQuestionMother
{
    public static function create(string $question, QuizStepAnswer ...$answers): QuizStepQuestion
    {
        return new QuizStepQuestion($question, ...$answers);
    }

    public static function creator(): callable
    {
        return static function (): QuizStepQuestion {
            return QuizStepQuestionMother::random();
        };
    }

    public static function random(): QuizStepQuestion
    {
        return self::create(TextMother::short(), ...RepeatMother::random(QuizStepAnswerMother::creator()));
    }
}

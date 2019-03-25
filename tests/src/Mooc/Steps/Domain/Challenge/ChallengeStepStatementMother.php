<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Steps\Domain\Challenge;

use CodelyTv\Mooc\Steps\Domain\Challenge\ChallengeStepStatement;
use CodelyTv\Test\Shared\Domain\TextMother;

final class ChallengeStepStatementMother
{
    public static function create(string $value): ChallengeStepStatement
    {
        return new ChallengeStepStatement($value);
    }

    public static function random(): ChallengeStepStatement
    {
        return self::create(TextMother::random());
    }
}

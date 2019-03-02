<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Shared\Domain;

final class TextMother
{
    public static function create(int $maxNumbersOfCharacters = 200): string
    {
        return MotherCreator::random()->text($maxNumbersOfCharacters);
    }

    public static function short(): string
    {
        return self::create(100);
    }

    public static function random(): string
    {
        return self::create(NumberMother::between(100, 2000));
    }

    public static function withMinLength(int $minLength): string
    {
        $numWords         = $minLength;
        $variableNumWords = false;

        return MotherCreator::random()->sentence($numWords, $variableNumWords);
    }
}

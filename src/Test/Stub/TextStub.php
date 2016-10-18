<?php

namespace CodelyTv\Test\Stub;

final class TextStub
{
    public static function create(int $maxNumbersOfCharacters = 200)
    {
        return StubCreator::random()->text($maxNumbersOfCharacters);
    }

    public static function short()
    {
        return self::create(100);
    }

    public static function random()
    {
        return self::create(NumberStub::between(100, 2000));
    }
}

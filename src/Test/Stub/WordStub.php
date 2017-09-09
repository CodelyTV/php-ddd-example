<?php

declare(strict_types=1);

namespace CodelyTv\Test\Stub;

final class WordStub
{
    public static function random()
    {
        return StubCreator::random()->word;
    }
}

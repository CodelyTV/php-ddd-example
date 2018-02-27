<?php

declare(strict_types=1);

namespace CodelyTv\Test\Shared\Domain;

final class WordStub
{
    public static function random()
    {
        return StubCreator::random()->word;
    }
}

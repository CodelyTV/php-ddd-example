<?php

namespace CodelyTv\Test\Stub;

final class WordStub
{
    public static function random()
    {
        return StubCreator::random()->word;
    }
}

<?php

namespace CodelyTv\Test\Infrastructure\Stub;

final class BoolStub
{
    public static function random()
    {
        return StubCreator::random()->boolean;
    }
}

<?php

namespace CodelyTv\Test\Stub;

final class BoolStub
{
    public static function random()
    {
        return StubCreator::random()->boolean;
    }
}

<?php

namespace CodelyTv\Test\Stub;

final class UuidStub
{
    public static function random()
    {
        return StubCreator::random()->unique()->uuid;
    }
}

<?php

namespace CodelyTv\Test\Stub;

final class UuidStub
{
    public static function random(): string
    {
        return StubCreator::random()->unique()->uuid;
    }
}

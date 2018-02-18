<?php

namespace CodelyTv\Test\Infrastructure\Stub;

final class UuidStub
{
    public static function random(): string
    {
        return StubCreator::random()->unique()->uuid;
    }
}

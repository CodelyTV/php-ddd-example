<?php

namespace CodelyTv\Test\Shared\Domain;

final class UuidStub
{
    public static function random(): string
    {
        return StubCreator::random()->unique()->uuid;
    }
}

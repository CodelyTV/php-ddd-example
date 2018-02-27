<?php

namespace CodelyTv\Test\Shared\Domain;

final class BoolStub
{
    public static function random()
    {
        return StubCreator::random()->boolean;
    }
}

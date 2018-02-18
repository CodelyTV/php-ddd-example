<?php

namespace CodelyTv\Test\Infrastructure\Stub;

final class RandomElementStub
{
    public static function from(array $choices)
    {
        return StubCreator::random()->randomElement($choices);
    }
}

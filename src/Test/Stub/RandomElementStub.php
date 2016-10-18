<?php

namespace CodelyTv\Test\Stub;

final class RandomElementStub
{
    public static function from(array $choices)
    {
        return StubCreator::random()->randomElement($choices);
    }
}

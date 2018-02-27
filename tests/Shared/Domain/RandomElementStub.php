<?php

namespace CodelyTv\Test\Shared\Domain;

final class RandomElementStub
{
    public static function from(array $choices)
    {
        return StubCreator::random()->randomElement($choices);
    }
}

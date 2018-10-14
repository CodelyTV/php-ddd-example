<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Shared\Domain;

final class Md5Stub
{
    public static function random()
    {
        return StubCreator::random()->md5;
    }
}

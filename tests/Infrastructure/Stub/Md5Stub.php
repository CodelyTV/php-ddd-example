<?php

namespace CodelyTv\Test\Infrastructure\Stub;

final class Md5Stub
{
    public static function random()
    {
        return StubCreator::random()->md5;
    }
}

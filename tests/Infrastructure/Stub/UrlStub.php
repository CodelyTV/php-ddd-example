<?php

namespace CodelyTv\Test\Infrastructure\Stub;

final class UrlStub
{
    public static function random() : string
    {
        return StubCreator::random()->url;
    }
}

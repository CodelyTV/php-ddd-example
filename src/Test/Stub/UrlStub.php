<?php

namespace CodelyTv\Test\Stub;

final class UrlStub
{
    public static function random() : string
    {
        return StubCreator::random()->url;
    }
}

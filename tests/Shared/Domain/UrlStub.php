<?php

namespace CodelyTv\Test\Shared\Domain;

final class UrlStub
{
    public static function random() : string
    {
        return StubCreator::random()->url;
    }
}

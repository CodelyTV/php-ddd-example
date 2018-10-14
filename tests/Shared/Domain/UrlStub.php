<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Shared\Domain;

final class UrlStub
{
    public static function random() : string
    {
        return StubCreator::random()->url;
    }
}

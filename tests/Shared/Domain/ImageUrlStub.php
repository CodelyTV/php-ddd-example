<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Shared\Domain;

final class ImageUrlStub
{
    public static function random()
    {
        return StubCreator::random()->imageUrl();
    }
}

<?php

namespace CodelyTv\Test\Shared\Domain;

final class ImageUrlStub
{
    public static function random()
    {
        return StubCreator::random()->imageUrl();
    }
}

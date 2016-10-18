<?php

namespace CodelyTv\Test\Stub;

final class ImageUrlStub
{
    public static function random()
    {
        return StubCreator::random()->imageUrl();
    }
}

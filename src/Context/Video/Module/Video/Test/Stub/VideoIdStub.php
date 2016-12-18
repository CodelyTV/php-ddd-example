<?php

namespace CodelyTv\Context\Video\Module\Video\Test\Stub;

use CodelyTv\Context\Video\Module\Video\Domain\VideoId;
use CodelyTv\Test\Stub\UuidStub;

final class VideoIdStub
{
    public static function create(string $id)
    {
        return new VideoId($id);
    }

    public static function random()
    {
        return self::create(UuidStub::random());
    }
}

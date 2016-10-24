<?php

namespace CodelyTv\Context\Meetup\Module\Video\Test\Stub;

use CodelyTv\Context\Meetup\Module\Video\Domain\VideoId;
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

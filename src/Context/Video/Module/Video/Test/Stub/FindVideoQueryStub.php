<?php

namespace CodelyTv\Context\Video\Module\Video\Test\Stub;

use CodelyTv\Context\Video\Module\Video\Domain\Find\FindVideoQuery;
use CodelyTv\Context\Video\Module\Video\Domain\VideoId;

final class FindVideoQueryStub
{
    public static function create(VideoId $id)
    {
        return new FindVideoQuery($id->value());
    }

    public static function random()
    {
        return self::create(VideoIdStub::random());
    }
}

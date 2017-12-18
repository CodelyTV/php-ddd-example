<?php

declare(strict_types=1);

namespace CodelyTv\Context\Video\Module\Video\Test\Stub;

use CodelyTv\Context\Video\Module\Video\Application\Find\FindVideoQuery;
use CodelyTv\Context\Video\Module\Video\Domain\VideoId;

final class FindVideoQueryStub
{
    public static function create(VideoId $id): FindVideoQuery
    {
        return new FindVideoQuery($id->value());
    }

    public static function random(): FindVideoQuery
    {
        return self::create(VideoIdStub::random());
    }
}

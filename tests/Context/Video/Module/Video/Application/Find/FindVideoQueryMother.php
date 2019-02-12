<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Context\Video\Module\Video\Application\Find;

use CodelyTv\Context\Video\Module\Video\Application\Find\FindVideoQuery;
use CodelyTv\Context\Video\Module\Video\Domain\VideoId;
use CodelyTv\Test\Context\Video\Module\Video\Domain\VideoIdMother;

final class FindVideoQueryMother
{
    public static function create(VideoId $id): FindVideoQuery
    {
        return new FindVideoQuery($id->value());
    }

    public static function random(): FindVideoQuery
    {
        return self::create(VideoIdMother::random());
    }
}

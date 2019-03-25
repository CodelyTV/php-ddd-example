<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Videos\Application\Find;

use CodelyTv\Mooc\Videos\Application\Find\FindVideoQuery;
use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Test\Mooc\Videos\Domain\VideoIdMother;

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

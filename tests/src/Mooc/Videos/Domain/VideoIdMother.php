<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Videos\Domain;

use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Test\Shared\Domain\UuidMother;

final class VideoIdMother
{
    public static function create(string $id): VideoId
    {
        return new VideoId($id);
    }

    public static function random(): VideoId
    {
        return self::create(UuidMother::random());
    }
}

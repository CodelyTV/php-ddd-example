<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Context\Video\Module\Video\Domain;

use CodelyTv\Context\Mooc\Module\Video\Domain\VideoId;
use CodelyTv\Test\Shared\Domain\UuidMother;

final class VideoIdMother
{
    public static function create(string $id)
    {
        return new VideoId($id);
    }

    public static function random()
    {
        return self::create(UuidMother::random());
    }
}

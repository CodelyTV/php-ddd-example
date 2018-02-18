<?php

declare(strict_types=1);

namespace CodelyTv\Test\Context\Video\Module\Video\Domain;

use CodelyTv\Context\Video\Module\Video\Domain\VideoId;
use CodelyTv\Test\Shared\Domain\UuidStub;

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

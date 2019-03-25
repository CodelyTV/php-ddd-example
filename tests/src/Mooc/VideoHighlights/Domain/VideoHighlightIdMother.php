<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\VideoHighlights\Domain;

use CodelyTv\Mooc\VideoHighlights\Domain\VideoHighlightId;
use CodelyTv\Test\Shared\Domain\UuidMother;

final class VideoHighlightIdMother
{
    public static function create(string $id): VideoHighlightId
    {
        return new VideoHighlightId($id);
    }

    public static function random(): VideoHighlightId
    {
        return self::create(UuidMother::random());
    }
}

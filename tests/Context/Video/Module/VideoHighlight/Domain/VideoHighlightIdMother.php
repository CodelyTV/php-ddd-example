<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Context\Video\Module\VideoHighlight\Domain;

use CodelyTv\Context\Mooc\Module\VideoHighlight\Domain\VideoHighlightId;
use CodelyTv\Test\Shared\Domain\UuidMother;

final class VideoHighlightIdMother
{
    public static function create(string $id)
    {
        return new VideoHighlightId($id);
    }

    public static function random()
    {
        return self::create(UuidMother::random());
    }
}

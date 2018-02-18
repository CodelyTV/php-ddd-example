<?php

namespace CodelyTv\Test\Context\Video\Module\VideoHighlight\Domain;

use CodelyTv\Context\Video\Module\VideoHighlight\Domain\VideoHighlightId;
use CodelyTv\Test\Infrastructure\Stub\UuidStub;

final class VideoHighlightIdStub
{
    public static function create(string $id)
    {
        return new VideoHighlightId($id);
    }

    public static function random()
    {
        return self::create(UuidStub::random());
    }
}

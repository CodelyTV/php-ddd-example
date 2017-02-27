<?php

namespace CodelyTv\Context\Video\Module\VideoHighlight\Test\Stub;

use CodelyTv\Context\Video\Module\VideoHighlight\Domain\VideoHighlightId;
use CodelyTv\Test\Stub\UuidStub;

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

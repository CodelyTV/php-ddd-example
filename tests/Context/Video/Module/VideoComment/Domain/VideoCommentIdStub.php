<?php

declare(strict_types=1);

namespace CodelyTv\Test\Context\Video\Module\VideoComment\Domain;

use CodelyTv\Context\Video\Module\VideoComment\Domain\VideoCommentId;
use CodelyTv\Test\Shared\Domain\UuidStub;

final class VideoCommentIdStub
{
    public static function create(string $id): VideoCommentId
    {
        return new VideoCommentId($id);
    }

    public static function random(): VideoCommentId
    {
        return self::create(UuidStub::random());
    }
}

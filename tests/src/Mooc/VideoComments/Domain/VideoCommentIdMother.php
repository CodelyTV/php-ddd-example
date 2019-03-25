<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\VideoComments\Domain;

use CodelyTv\Mooc\VideoComments\Domain\VideoCommentId;
use CodelyTv\Test\Shared\Domain\UuidMother;

final class VideoCommentIdMother
{
    public static function create(string $id): VideoCommentId
    {
        return new VideoCommentId($id);
    }

    public static function random(): VideoCommentId
    {
        return self::create(UuidMother::random());
    }
}

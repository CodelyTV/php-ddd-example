<?php

declare(strict_types=1);

namespace CodelyTv\Test\Context\Video\Module\Review\Domain;

use CodelyTv\Context\Video\Module\Review\Domain\ReviewId;
use CodelyTv\Test\Shared\Domain\UuidStub;

final class ReviewIdStub
{
    public static function create(string $id)
    {
        return new ReviewId($id);
    }

    public static function random()
    {
        return self::create(UuidStub::random());
    }
}

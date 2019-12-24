<?php

declare(strict_types = 1);

namespace CodelyTv\Test\Mooc\Videos\Domain;

use CodelyTv\Mooc\Videos\Domain\VideoDescription;
use CodelyTv\Test\Shared\Domain\WordMother;

final class VideoDescriptionMother
{
    public static function create(string $description): VideoDescription
    {
        return new VideoDescription($description);
    }

    public static function random(): VideoDescription
    {
        return self::create(WordMother::random());
    }
}

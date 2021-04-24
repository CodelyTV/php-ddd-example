<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\Videos\Domain;


use CodelyTv\Mooc\Videos\Domain\VideoId;
use CodelyTv\Tests\Shared\Domain\UuidMother;

final class VideoIdMother
{
    public static function create(?string $value = null): VideoId
    {
        return new VideoId($value ?? UuidMother::create());
    }
}

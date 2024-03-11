<?php

namespace CodelyTv\Tests\Mooc\Videos\Domain;

use CodelyTv\Mooc\Videos\Domain\VideoType;

class VideoTypeMother
{
    public static function create(?string $value = null): VideoType
    {
        return new VideoType($value ?? VideoType::random()->value());
    }
}

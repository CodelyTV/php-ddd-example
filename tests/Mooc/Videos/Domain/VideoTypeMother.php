<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\Videos\Domain;

use CodelyTv\Mooc\Videos\Domain\VideoType;
use CodelyTv\Tests\Shared\Domain\TypeMother;

final class VideoTypeMother
{
    public static function create(?string $value = null): VideoType
    {
        return new VideoType($value ?? TypeMother::create());
    }
}

<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\Videos\Domain;


use CodelyTv\Mooc\Shared\Domain\Videos\VideoUrl;
use CodelyTv\Tests\Shared\Domain\UrlMother;

final class VideoUrlMother
{
    public static function create(?string $value = null): VideoUrl
    {
        return new VideoUrl($value ?? UrlMother::create());
    }
}

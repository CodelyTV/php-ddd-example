<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\LastVideo\Domain;

use CodelyTv\Mooc\LastVideo\Domain\LastVideoUrl;
use CodelyTv\Tests\Shared\Domain\UrlMother;

final class LastVideoUrlMother
{
    public static function create(?string $value = null): LastVideoUrl
    {
        return new LastVideoUrl($value ?? UrlMother::create());
    }
}

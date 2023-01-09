<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\LastVideo\Domain;

use CodelyTv\Mooc\LastVideo\Domain\LastVideoId;
use CodelyTv\Tests\Shared\Domain\UuidMother;

final class LastVideoIdMother
{
    public static function create(?string $value = null): LastVideoId
    {
        return new LastVideoId($value ?? UuidMother::create());
    }
}

<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\LastVideo\Domain;

use CodelyTv\Mooc\LastVideo\Domain\LastVideoCreatedAt;
use CodelyTv\Tests\Shared\Domain\DateMother;

final class LastVideoCreatedAtMother
{
    public static function create(?string $value = null): LastVideoCreatedAt
    {
        return new LastVideoCreatedAt($value ?? DateMother::create());
    }
}

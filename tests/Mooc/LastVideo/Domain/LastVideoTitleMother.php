<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\LastVideo\Domain;

use CodelyTv\Mooc\LastVideo\Domain\LastVideoTitle;
use CodelyTv\Tests\Shared\Domain\WordMother;

final class LastVideoTitleMother
{
    public static function create(?string $value = null): LastVideoTitle
    {
        return new LastVideoTitle($value ?? WordMother::create());
    }
}

<?php

declare(strict_types=1);

namespace CodelyTv\Tests\Mooc\LastVideo\Domain;

use CodelyTv\Mooc\LastVideo\Domain\LastVideoType;

final class LastVideoTypeMother
{

    public static function create(?string $value = null): LastVideoType
    {
        return new LastVideoType($value ??  LastVideoType::randomValue());
    }

}

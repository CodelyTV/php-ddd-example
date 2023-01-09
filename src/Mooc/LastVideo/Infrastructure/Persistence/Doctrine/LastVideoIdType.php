<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\LastVideo\Infrastructure\Persistence\Doctrine;

use CodelyTv\Mooc\LastVideo\Domain\LastVideoId;
use CodelyTv\Shared\Infrastructure\Persistence\Doctrine\UuidType;

final class LastVideoIdType extends UuidType
{

    protected function typeClassName(): string
    {
        return LastVideoId::class;
    }
}

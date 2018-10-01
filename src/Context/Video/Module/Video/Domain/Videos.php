<?php

declare(strict_types = 1);

namespace CodelyTv\Context\Video\Module\Video\Domain;

use CodelyTv\Shared\Domain\Collection;

final class Videos extends Collection
{
    protected function type(): string
    {
        return Video::class;
    }
}

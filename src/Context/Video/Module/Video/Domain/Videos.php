<?php

declare(strict_types = 1);

namespace CodelyTv\Context\Video\Module\Video\Domain;

use CodelyTv\Types\Collection;

final class Videos extends Collection
{
    protected function type(): string
    {
        return Video::class;
    }
}

<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\LastVideo\Domain;

use CodelyTv\Shared\Domain\Collection;

final class LastVideos extends Collection
{
    protected function type(): string
    {
        return LastVideo::class;
    }
}

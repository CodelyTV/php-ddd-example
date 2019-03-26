<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Videos\Application\Find;

use CodelyTv\Shared\Domain\Bus\Query\Query;

final class FindLatestPublishedVideoQuery implements Query
{
    public function __construct()
    {
    }
}

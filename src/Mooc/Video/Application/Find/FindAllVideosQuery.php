<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Video\Application\Find;

use CodelyTv\Shared\Domain\Bus\Query\Query;

final class FindAllVideosQuery implements Query
{
    public function __construct()
    {
    }
}

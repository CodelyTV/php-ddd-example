<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\CoursesCounter\Application\Find;

use CodelyTv\Shared\Domain\Bus\Query\Response;

final class CoursesCounterResponse implements Response
{
    public function __construct(private readonly int $total)
    {
    }

    public function total(): int
    {
        return $this->total;
    }
}

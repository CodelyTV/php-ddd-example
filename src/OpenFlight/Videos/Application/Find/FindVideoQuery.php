<?php

declare(strict_types=1);

namespace CodelyTv\OpenFlight\Videos\Application\Find;

use CodelyTv\Shared\Domain\Bus\Query\Query;

final class FindVideoQuery implements Query
{
    public function __construct(private string $id)
    {
    }

    public function id(): string
    {
        return $this->id;
    }
}

<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Pokemon\Application\Find;

use CodelyTv\Shared\Domain\Bus\Query\Query;

final readonly class FindPokemonQuery implements Query
{
    public function __construct(private int $id) {}

    public function id(): int
    {
        return $this->id;
    }
}

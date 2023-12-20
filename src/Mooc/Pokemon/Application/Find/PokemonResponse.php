<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Pokemon\Application\Find;

use CodelyTv\Shared\Domain\Bus\Query\Response;

final readonly class PokemonResponse implements Response
{
    public function __construct(
        private int $id,
        private string $name
    ) {}
}

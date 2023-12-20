<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Pokemon\Application\Find;

use CodelyTv\Mooc\Pokemon\Domain\Entity\Pokemon;

final class PokemonResponseConverter
{
    public function __invoke(Pokemon $pokemon): PokemonResponse
    {
        return new PokemonResponse(
            id: $pokemon->id(),
            name: $pokemon->name()
        );
    }
}

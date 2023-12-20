<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Pokemon\Domain\ExternalServices;

use CodelyTv\Mooc\Pokemon\Domain\Entity\Pokemon;

interface PokemonApiInterface
{
    public function getPokemon(int $id): ?Pokemon;
}
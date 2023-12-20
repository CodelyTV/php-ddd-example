<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Pokemon\Domain;

use CodelyTv\Mooc\Pokemon\Domain\Entity\Pokemon;
use CodelyTv\Mooc\Pokemon\Domain\Error\PokemonNotExists;
use CodelyTv\Mooc\Pokemon\Domain\ExternalServices\PokemonApiInterface;

readonly class PokemonFinder
{

    public function __construct(private PokemonApiInterface $pokemonApi)
    {
    }

    public function __invoke(int $id): Pokemon
    {

        $pokemon = $this->pokemonApi->getPokemon($id);

        if (null === $pokemon) {
            throw new PokemonNotExists($id);
        }

        return $pokemon;
    }

}
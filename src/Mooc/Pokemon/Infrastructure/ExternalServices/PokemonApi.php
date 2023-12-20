<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Pokemon\Infrastructure\ExternalServices;

use CodelyTv\Mooc\Pokemon\Domain\Entity\Pokemon;
use CodelyTv\Mooc\Pokemon\Domain\ExternalServices\PokemonApiInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class PokemonApi implements PokemonApiInterface
{

    private const ENDPOINT = "https://pokeapi.co/api/v2/pokemon/";

    public function __construct(
        private HttpClientInterface $client,
    ) {
    }

    public function getPokemon(int $id): ?Pokemon
    {
        $response = $this->client->request(
            'GET',
            self::ENDPOINT . $id
        );
        if(200 !== $response->getStatusCode()){
            return null;
        }
        $pokemonArray = $response->toArray();

        return Pokemon::create(
            id: $pokemonArray["id"],
            name: $pokemonArray["name"]
        );

    }
}
<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Pokemon\Application\Find;

use CodelyTv\Mooc\Pokemon\Domain\PokemonFinder;
use CodelyTv\Shared\Domain\Bus\Query\QueryHandler;

use function Lambdish\Phunctional\apply;

final readonly class FindPokemonQueryHandler implements QueryHandler
{

    public function __construct(
        private PokemonFinder $finder,
        private PokemonResponseConverter $responseConverter
    )
    {
    }

    public function __invoke(int $id): PokemonResponse
    {
        $pokemon = apply($this->finder, [$id]);

        return apply($this->responseConverter, [$pokemon]);
    }
}

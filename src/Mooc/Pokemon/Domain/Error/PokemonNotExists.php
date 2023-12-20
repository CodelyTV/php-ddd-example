<?php

declare(strict_types=1);

namespace CodelyTv\Mooc\Pokemon\Domain\Error;

use CodelyTv\Shared\Domain\DomainError;

final class PokemonNotExists extends DomainError
{
    public function __construct(private readonly int $id)
    {
        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'pokemon_not_found';
    }

    protected function errorMessage(): string
    {
        return sprintf('The pokemon <%s> has not been found', $this->id);
    }
}

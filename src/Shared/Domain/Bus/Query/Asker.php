<?php

declare(strict_types = 1);

namespace CodelyTv\Shared\Domain\Bus\Query;

final class Asker
{
    private $queryBus;

    public function __construct(QueryBus $queryBus)
    {
        $this->queryBus = $queryBus;
    }

    public function __invoke(Query $query): ?Response
    {
        return $this->queryBus->ask($query);
    }
}

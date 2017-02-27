<?php

namespace CodelyTv\Shared\Domain\Bus\Query;

final class Asker
{
    private $queryBus;

    public function __construct(QueryBus $queryBus)
    {
        $this->queryBus = $queryBus;
    }

    /** @return Response|null */
    public function __invoke(Query $query)
    {
        return $this->queryBus->ask($query);
    }
}

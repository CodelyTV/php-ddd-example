<?php

namespace CodelyTv\Infrastructure\Bus\Query;

final class Asker
{
    private $oracle;

    public function __construct(Oracle $oracle)
    {
        $this->oracle = $oracle;
    }

    /** @return Response|null */
    public function __invoke(Query $query)
    {
        return $this->oracle->ask($query);
    }
}

<?php

namespace CodelyTv\Shared\Domain\Bus\Query;

use RuntimeException;

interface QueryBus
{
    /**
     * @throws RuntimeException
     *
     * @return void
     */
    public function register($queryClass, callable $handler);

    /**
     * @throws RuntimeException
     *
     * @return Response|null
     */
    public function ask(Query $query);
}

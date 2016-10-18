<?php

namespace CodelyTv\Infrastructure\Bus\Query;

use RuntimeException;

interface Oracle
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

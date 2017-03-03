<?php

namespace CodelyTv\Infrastructure\Symfony\Bundle\DependencyInjection\Compiler;

use RuntimeException;

final class TransactionalServiceByTagNotDefined extends RuntimeException
{
    public function __construct(string $service)
    {
        parent::__construct(sprintf('The "by" tag is not defined inside the <%s> transactional definition', $service));
    }
}

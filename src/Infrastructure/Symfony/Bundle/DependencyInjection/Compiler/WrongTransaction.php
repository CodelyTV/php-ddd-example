<?php

namespace CodelyTv\Infrastructure\Symfony\Bundle\DependencyInjection\Compiler;

use Exception;
use RuntimeException;

final class WrongTransaction extends RuntimeException
{
    private $originalException;

    public function __construct(Exception $originalException)
    {
        $this->originalException = $originalException;

        parent::__construct(sprintf('Transaction ended with <%s> exception', get_class($originalException)));
    }

    public function originalException(): Exception
    {
        return $this->originalException;
    }
}

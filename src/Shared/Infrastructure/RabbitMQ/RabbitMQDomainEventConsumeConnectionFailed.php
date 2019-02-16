<?php

declare(strict_types = 1);

namespace CodelyTv\Shared\Infrastructure\RabbitMQ;

use Exception;
use RuntimeException;

final class RabbitMQDomainEventConsumeConnectionFailed extends RuntimeException
{
    public function __construct($message, Exception $previous = null)
    {
        parent::__construct($message, 0, $previous);
    }
}

<?php

declare(strict_types = 1);

namespace CodelyTv\Infrastructure\RabbitMQ;

final class RabbitMQQueueNameFormatter
{
    const QUEUE_PREFIX = 'codelytv_php_api';

    public static function format(string $name)
    {
        return sprintf('%s.%s', self::QUEUE_PREFIX, $name);
    }
}

<?php

declare (strict_types = 1);

namespace CodelyTv\Infrastructure\Bus\Middleware;

use CodelyTv\Shared\Domain\Bus\Message;
use Psr\Log\LoggerInterface;

final class MessageLoggerMiddleware implements Middleware
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function __invoke(Message $message, callable $handler): ?callable
    {
        $this->logger->debug(
            'New message dispatched',
            [
                'type' => $message->messageType(),
                'name' => $this->nameOf($message),
            ]
        );

        return $handler($message);
    }

    private function nameOf(Message $message): string
    {
        return get_class($message);
    }
}

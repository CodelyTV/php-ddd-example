<?php

declare (strict_types = 1);

namespace CodelyTv\Infrastructure\Bus\Middleware;

use CodelyTv\Shared\Domain\Bus\Message;
use function Lambdish\Phunctional\apply;
use Psr\Log\LoggerInterface;

final class MessageLoggerWrapper
{
    private $logger;
    private $handler;

    public function __construct(LoggerInterface $logger, callable $handler)
    {
        $this->logger  = $logger;
        $this->handler = $handler;
    }

    public function __invoke(Message $message): void
    {
        $this->logger->debug(
            'New message dispatched',
            [
                'type' => $message->messageType(),
                'name' => $this->nameOf($message),
            ]
        );

        apply($this->handler, [$message]);
    }

    private function nameOf(Message $message): string
    {
        return get_class($message);
    }
}

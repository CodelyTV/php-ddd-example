<?php

declare(strict_types=1);

namespace CodelyTv\Shared\Infrastructure\Logger;

use CodelyTv\Shared\Domain\Logger;

final readonly class MonologLogger implements Logger
{
	public function __construct(private \Monolog\Logger $logger) {}

	public function info(string $message, array $context = []): void
	{
		$this->logger->info($message, $context);
	}

	public function warning(string $message, array $context = []): void
	{
		$this->logger->warning($message, $context);
	}

	public function critical(string $message, array $context = []): void
	{
		$this->logger->critical($message, $context);
	}
}

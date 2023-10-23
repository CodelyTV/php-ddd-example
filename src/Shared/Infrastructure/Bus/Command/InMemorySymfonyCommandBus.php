<?php

declare(strict_types=1);

namespace CodelyTv\Shared\Infrastructure\Bus\Command;

use CodelyTv\Shared\Domain\Bus\Command\Command;
use CodelyTv\Shared\Domain\Bus\Command\CommandBus;
use CodelyTv\Shared\Infrastructure\Bus\CallableFirstParameterExtractor;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\Exception\NoHandlerForMessageException;
use Symfony\Component\Messenger\Handler\HandlersLocator;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Messenger\Middleware\HandleMessageMiddleware;

final class InMemorySymfonyCommandBus implements CommandBus
{
	private readonly MessageBus $bus;

	public function __construct(iterable $commandHandlers)
	{
		$this->bus = new MessageBus(
			[
				new HandleMessageMiddleware(
					new HandlersLocator(CallableFirstParameterExtractor::forCallables($commandHandlers))
				),
			]
		);
	}

	public function dispatch(Command $command): void
	{
		try {
			$this->bus->dispatch($command);
		} catch (NoHandlerForMessageException) {
			throw new CommandNotRegisteredError($command);
		} catch (HandlerFailedException $error) {
			throw $error->getPrevious() ?? $error;
		}
	}
}

<?php

namespace CodelyTv\Infrastructure\Bus\Command;

use CodelyTv\Infrastructure\Bus\Middleware\Middleware;
use CodelyTv\Shared\Domain\Bus\Command\Command;
use CodelyTv\Shared\Domain\Bus\Command\CommandBus;
use CodelyTv\Shared\Domain\Bus\Message;
use Prooph\ServiceBus\CommandBus as ProophCommandBus;
use Prooph\ServiceBus\Plugin\Router\CommandRouter;
use RuntimeException;
use function Lambdish\Phunctional\first;
use function Lambdish\Phunctional\get;
use function Lambdish\Phunctional\reduce;
use function Lambdish\Phunctional\rest;

final class CommandBusSync implements CommandBus
{
    private $middlewares;
    private $bus;
    private $router;
    private $routerIsAttached = false;

    public function __construct(Middleware ...$middlewares)
    {
        $this->middlewares = $middlewares;
        $this->bus         = new ProophCommandBus();
        $this->router      = new CommandRouter();
    }

    public function register($commandClass, callable $handler): void
    {
        $this->guardRouterIsAttached();

        $this->router->route($commandClass)->to($this->withMiddlewares($handler));
    }

    /** @todo Raise own exception if there is no handler */
    public function dispatch(Command $command)
    {
        $this->attachRouter();

        $this->bus->dispatch($command);
    }

    private function guardRouterIsAttached()
    {
        if ($this->routerIsAttached) {
            throw new RuntimeException('Trying to register a new handler after some dispatch has been done');
        }
    }

    private function attachRouter()
    {
        if (!$this->routerIsAttached) {
            $this->bus->utilize($this->router);

            $this->routerIsAttached = true;
        }
    }

    private function withMiddlewares($handler)
    {
        return function (Message $message) use ($handler): void {
            if (empty($this->middlewares)) {
                $handler($message);

                return;
            }

            $middlewares     = $this->middlewares;
            $firstMiddleware = first($middlewares);
            $nextMiddlewares = reduce($this->addMiddleware($message, $handler), rest($this->middlewares)) ?: $handler;

            $firstMiddleware($message, $nextMiddlewares);
        };
    }

    private function addMiddleware(Message $message, callable $handler)
    {
        return function (?callable $withMiddlewares, callable $middleware, int $key) use ($message, $handler) {
            if (null === $withMiddlewares) {
                return $middleware;
            }

            return $middleware($message, $this->nextMiddleware($key, $handler));
        };
    }

    private function nextMiddleware(int $key, callable $handler)
    {
        return get($key + 1, $this->middlewares, $handler);
    }
}

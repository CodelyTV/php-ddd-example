<?php

declare (strict_types = 1);

namespace CodelyTv\MoocBackend\Controller\AsyncRequest;

use CodelyTv\Shared\Domain\ValueObject\Uuid;
use CodelyTv\Shared\Infrastructure\Api\Exception\ApiExceptionsHttpStatusCodeMapping;
use CodelyTv\Shared\Infrastructure\Bus\AsyncRequestFinder;
use CodelyTv\Shared\Infrastructure\Bus\AsyncRequestNotExists;
use Symfony\Component\HttpFoundation\Response;
use function Lambdish\Phunctional\each;

final class AsyncRequestGetController
{
    private $asyncRequestFinder;
    private $exceptionHandler;

    public function __construct(
        AsyncRequestFinder $asyncRequestFinder,
        ApiExceptionsHttpStatusCodeMapping $exceptionHandler
    ) {
        $this->asyncRequestFinder = $asyncRequestFinder;
        $this->exceptionHandler   = $exceptionHandler;

        each($this->exceptionRegistrar(), $this->exceptions());
    }

    public function __invoke($requestId)
    {
        $asyncRequest = $this->asyncRequestFinder->__invoke(new Uuid($requestId));

        return $asyncRequest->toArray();
    }

    private function exceptions(): array
    {
        return [
            AsyncRequestNotExists::class => Response::HTTP_NOT_FOUND,
        ];
    }

    private function exceptionRegistrar(): callable
    {
        return function ($httpCode, $exception) {
            $this->exceptionHandler->register($exception, $httpCode);
        };
    }
}

<?php

declare (strict_types = 1);

namespace CodelyTv\Api\Controller\AsyncRequest;

use CodelyTv\Api\Infrastructure\Exception\ApiExceptionsHttpStatusCodeMapping;
use CodelyTv\Infrastructure\Bus\AsyncRequestFinder;
use CodelyTv\Infrastructure\Bus\AsyncRequestNotExists;
use CodelyTv\Types\ValueObject\Uuid;
use function Lambdish\Phunctional\each;
use Symfony\Component\HttpFoundation\Response;

final class AsyncRequestGetController
{
    private $asyncRequestFinder;
    private $exceptionHandler;

    public function __construct(AsyncRequestFinder $asyncRequestFinder, ApiExceptionsHttpStatusCodeMapping $exceptionHandler)
    {
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

    private function exceptionRegistrar()
    {
        return function ($httpCode, $exception) {
            $this->exceptionHandler->register($exception, $httpCode);
        };
    }
}

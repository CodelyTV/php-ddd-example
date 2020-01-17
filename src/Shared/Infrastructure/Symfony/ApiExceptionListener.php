<?php

declare(strict_types = 1);

namespace CodelyTv\Shared\Infrastructure\Symfony;

use CodelyTv\Shared\Domain\DomainError;
use CodelyTv\Shared\Domain\Utils;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\RequestEvent;

final class ApiExceptionListener
{
    private $exceptionHandler;

    public function __construct(ApiExceptionsHttpStatusCodeMapping $exceptionHandler)
    {
        $this->exceptionHandler = $exceptionHandler;
    }

    public function onException(RequestEvent $event): void
    {
        $exception = $event->getException();

        $event->setResponse(
            new JsonResponse(
                [
                    'code'    => $this->exceptionCodeFor($exception),
                    'message' => $exception->getMessage(),
                ],
                $this->exceptionHandler->statusCodeFor(get_class($exception))
            )
        );
    }

    private function exceptionCodeFor(Exception $error)
    {
        $domainErrorClass = DomainError::class;

        return $error instanceof $domainErrorClass ? $error->errorCode() : Utils::toSnakeCase(class_basename($error));
    }
}

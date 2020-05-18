<?php

declare(strict_types = 1);

namespace CodelyTv\Shared\Infrastructure\Symfony;

use CodelyTv\Shared\Domain\DomainError;
use CodelyTv\Shared\Domain\Utils;
use Exception;
use ReflectionClass;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Event\RequestEvent;

final class ApiExceptionListener
{
    private $exceptionHandler;

    public function __construct(ApiExceptionsHttpStatusCodeMapping $exceptionHandler)
    {
        $this->exceptionHandler = $exceptionHandler;
    }

    public function onException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

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

    private function exceptionCodeFor(\Throwable $error)
    {
        $domainErrorClass = DomainError::class;
        return $error instanceof $domainErrorClass ? $error->errorCode() : Utils::toSnakeCase($this->getClassBasename($error));
    }

    //todo do be refactored
    private function getClassBasename($object) {
        $reflect = new ReflectionClass($object);
        return $reflect->getShortName();
    }

}

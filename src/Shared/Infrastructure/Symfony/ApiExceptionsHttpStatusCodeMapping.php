<?php

declare(strict_types = 1);

namespace CodelyTv\Shared\Infrastructure\Symfony;

use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use function Lambdish\Phunctional\get;

final class ApiExceptionsHttpStatusCodeMapping
{
    private const DEFAULT_STATUS_CODE = Response::HTTP_INTERNAL_SERVER_ERROR;

    private $exceptions = [
        InvalidArgumentException::class => Response::HTTP_BAD_REQUEST,
        NotFoundHttpException::class    => Response::HTTP_NOT_FOUND,
    ];

    public function register($exceptionClass, $statusCode): void
    {
        $this->exceptions[$exceptionClass] = $statusCode;
    }

    public function exists($exceptionClass): bool
    {
        return array_key_exists($exceptionClass, $this->exceptions);
    }

    public function statusCodeFor($exceptionClass): int
    {
        return get($exceptionClass, $this->exceptions, self::DEFAULT_STATUS_CODE);
    }
}

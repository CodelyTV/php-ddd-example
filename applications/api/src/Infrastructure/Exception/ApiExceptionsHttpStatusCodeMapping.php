<?php

namespace CodelyTv\Api\Infrastructure\Exception;

use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Response;

final class ApiExceptionsHttpStatusCodeMapping
{
    private $exceptions = [
        InvalidArgumentException::class => Response::HTTP_BAD_REQUEST
    ];

    public function register($exceptionClass, $statusCode)
    {
        $this->exceptions[$exceptionClass] = $statusCode;
    }

    public function exists($exceptionClass)
    {
        return array_key_exists($exceptionClass, $this->exceptions);
    }

    public function getStatusCode($exceptionClass)
    {
        return $this->exceptions[$exceptionClass];
    }
}

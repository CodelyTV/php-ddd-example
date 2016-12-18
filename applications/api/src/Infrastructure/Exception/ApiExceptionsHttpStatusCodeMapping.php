<?php

namespace CodelyTv\Api\Infrastructure\Exception;

final class ApiExceptionsHttpStatusCodeMapping
{
    private $exceptions = [];

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

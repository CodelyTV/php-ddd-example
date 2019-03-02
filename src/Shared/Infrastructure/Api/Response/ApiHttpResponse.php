<?php

declare(strict_types = 1);

namespace CodelyTv\Shared\Infrastructure\Api\Response;

use Symfony\Component\HttpFoundation\Response;

abstract class ApiHttpResponse
{
    private $data;
    private $statusCode;
    private $headers;

    public function __construct(?array $data, int $statusCode = Response::HTTP_OK, array $headers = [])
    {
        $this->data       = $data;
        $this->statusCode = $statusCode;
        $this->headers    = $headers;
    }

    public function data()
    {
        return $this->data;
    }

    public function statusCode()
    {
        return $this->statusCode;
    }

    public function headers()
    {
        return $this->headers;
    }
}

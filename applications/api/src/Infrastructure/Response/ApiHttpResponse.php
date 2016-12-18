<?php

namespace CodelyTv\Api\Infrastructure\Response;

use Symfony\Component\HttpFoundation\Response;

class ApiHttpResponse
{
    private $data;
    private $statusCode;
    private $headers;

    public function __construct($data, $statusCode = Response::HTTP_OK, array $headers = [])
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

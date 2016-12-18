<?php

namespace CodelyTv\Api\Infrastructure\Response;

use Symfony\Component\HttpFoundation\Response;

final class ApiHttpCreatedResponse extends ApiHttpResponse
{
    public function __construct($data = null, array $headers = [])
    {
        parent::__construct($data, Response::HTTP_CREATED, $headers);
    }
}

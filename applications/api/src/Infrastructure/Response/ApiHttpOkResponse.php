<?php

namespace CodelyTv\Api\Infrastructure\Response;

use Symfony\Component\HttpFoundation\Response;

final class ApiHttpOkResponse extends ApiHttpResponse
{
    public function __construct($data = null, array $headers = [])
    {
        parent::__construct($data, Response::HTTP_OK, $headers);
    }
}

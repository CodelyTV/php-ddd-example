<?php

namespace CodelyTv\Api\Infrastructure\Response;

use CodelyTv\Types\ValueObject\Uuid;
use Symfony\Component\HttpFoundation\Response;

final class ApiHttpAcceptedResponse extends ApiHttpResponse
{
    public function __construct(string $currentUrl, Uuid $requestId, array $headers = [])
    {
        parent::__construct(
            [],
            Response::HTTP_ACCEPTED,
            array_merge(['Location' => sprintf('%s/status/%s', $currentUrl, $requestId->value())], $headers)
        );
    }
}

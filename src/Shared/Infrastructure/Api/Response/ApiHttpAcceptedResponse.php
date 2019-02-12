<?php

declare(strict_types = 1);

namespace CodelyTv\Shared\Infrastructure\Api\Response;

use CodelyTv\Shared\Domain\ValueObject\Uuid;
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

<?php

declare(strict_types=1);

namespace CodelyTv\Apps\OpenFlight\Backend\Controller\HealthCheck;

use CodelyTv\Shared\Domain\RandomNumberGenerator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class HealthCheckGetController
{
    public function __construct(private RandomNumberGenerator $generator)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        return new JsonResponse(
            [
                'openflight-backend' => 'ok',
                'rand'         => $this->generator->generate(),
            ]
        );
    }
}

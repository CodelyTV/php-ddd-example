<?php

declare(strict_types=1);

namespace CodelyTv\Apps\OpenFlight\Backend\Controller\HealthCheck;

use CodelyTv\Shared\Domain\RandomNumberGenerator;
use CodelyTv\Shared\Infrastructure\Persistence\Mysql;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class HealthCheckGetController
{
    public function __construct(private RandomNumberGenerator $generator, private Mysql $mysql)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {

        return new JsonResponse(
            [
                'openflight-backend' => 'ok',
                'rand' => $this->generator->generate(),
            ]
        );
    }
}

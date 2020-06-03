<?php

declare(strict_types=1);

namespace CodelyTv\Apps\Mooc\Backend\Controller\HealthCheck;

use CodelyTv\Shared\Domain\RandomNumberGenerator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class HealthCheckGetController
{
    private RandomNumberGenerator $generator;

    public function __construct(RandomNumberGenerator $generator)
    {
        $this->generator = $generator;
    }

    public function __invoke(Request $request): JsonResponse
    {
        return new JsonResponse(
            [
                'mooc-backend' => 'ok',
                'rand'         => $this->generator->generate(),
            ]
        );
    }
}

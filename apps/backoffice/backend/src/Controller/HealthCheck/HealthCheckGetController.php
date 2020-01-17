<?php

declare(strict_types = 1);

namespace CodelyTv\Apps\Backoffice\Backend\Controller\HealthCheck;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class HealthCheckGetController
{
    public function __invoke(Request $request): Response
    {
        return new JsonResponse(
            [
                'backoffice-backend' => 'ok',
            ]
        );
    }
}

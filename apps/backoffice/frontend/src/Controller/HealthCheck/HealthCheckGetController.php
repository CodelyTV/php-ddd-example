<?php

declare(strict_types=1);

namespace CodelyTv\Apps\Backoffice\Frontend\Controller\HealthCheck;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class HealthCheckGetController
{
	public function __invoke(Request $request): JsonResponse
	{
		return new JsonResponse(
			[
				'backoffice-frontend' => 'ok',
			]
		);
	}
}

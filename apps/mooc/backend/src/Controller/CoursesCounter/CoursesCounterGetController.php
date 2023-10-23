<?php

declare(strict_types=1);

namespace CodelyTv\Apps\Mooc\Backend\Controller\CoursesCounter;

use CodelyTv\Mooc\CoursesCounter\Application\Find\CoursesCounterResponse;
use CodelyTv\Mooc\CoursesCounter\Application\Find\FindCoursesCounterQuery;
use CodelyTv\Mooc\CoursesCounter\Domain\CoursesCounterNotExist;
use CodelyTv\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class CoursesCounterGetController extends ApiController
{
	public function __invoke(): JsonResponse
	{
		/** @var CoursesCounterResponse $response */
		$response = $this->ask(new FindCoursesCounterQuery());

		return new JsonResponse(
			[
				'total' => $response->total(),
			]
		);
	}

	protected function exceptions(): array
	{
		return [
			CoursesCounterNotExist::class => Response::HTTP_NOT_FOUND,
		];
	}
}

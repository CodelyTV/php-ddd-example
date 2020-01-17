<?php

declare(strict_types = 1);

namespace CodelyTv\Apps\Mooc\Backend\Controller\CoursesCounter;

use CodelyTv\Mooc\CoursesCounter\Application\Find\CoursesCounterFinder;
use CodelyTv\Mooc\CoursesCounter\Application\Find\CoursesCounterResponse;
use CodelyTv\Mooc\CoursesCounter\Application\Find\FindCoursesCounterQuery;
use CodelyTv\Shared\Domain\Bus\Query\QueryBus;
use Symfony\Component\HttpFoundation\JsonResponse;

final class CoursesCounterGetController
{
    private $bus;

    public function __construct(QueryBus $bus)
    {
        $this->bus = $bus;
    }

    public function __invoke()
    {
        /** @var CoursesCounterResponse $response */
        $response = $this->bus->ask(new FindCoursesCounterQuery());

        return new JsonResponse(
            [
                'total' => $response->total(),
            ]
        );
    }
}

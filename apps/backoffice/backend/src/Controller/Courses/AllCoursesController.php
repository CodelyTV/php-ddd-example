<?php

namespace CodelyTv\Apps\Backoffice\Backend\Controller\Courses;

use CodelyTv\Backoffice\Courses\Application\BackofficeCourseResponse;
use CodelyTv\Backoffice\Courses\Application\BackofficeCoursesResponse;
use CodelyTv\Backoffice\Courses\Application\SearchAll\SearchAllBackofficeCoursesQuery;
use CodelyTv\Shared\Domain\Bus\Query\QueryBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use function Lambdish\Phunctional\map;

class AllCoursesController
{
    public function __construct(private QueryBus $queryBus)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        /** @var BackofficeCoursesResponse $response */
        $response = $this->queryBus->ask(new SearchAllBackofficeCoursesQuery());

        return new JsonResponse(
            map(
                fn(BackofficeCourseResponse $course) => [
                    'id'       => $course->id(),
                    'name'     => $course->name(),
                    'duration' => $course->duration(),
                ],
                $response->courses()
            ),
            200,
            ['Access-Control-Allow-Origin' => '*']
        );
    }
}

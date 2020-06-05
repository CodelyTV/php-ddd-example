<?php

declare(strict_types=1);

namespace CodelyTv\Apps\Backoffice\Backend\Controller\Courses;

use CodelyTv\Backoffice\Courses\Application\BackofficeCourseResponse;
use CodelyTv\Backoffice\Courses\Application\BackofficeCoursesResponse;
use CodelyTv\Backoffice\Courses\Application\SearchByCriteria\SearchBackofficeCoursesByCriteriaQuery;
use CodelyTv\Shared\Domain\Bus\Query\QueryBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use function Lambdish\Phunctional\map;

final class CoursesGetController
{
    private $queryBus;

    public function __construct(QueryBus $queryBus)
    {
        $this->queryBus = $queryBus;
    }

    public function __invoke(Request $request): JsonResponse
    {
        /** @var BackofficeCoursesResponse $response */
        $response = $this->queryBus->ask(
            new SearchBackofficeCoursesByCriteriaQuery(
                $request->query->get('filters', []),
                $request->query->get('order_by'),
                $request->query->get('order'),
                $request->query->get('limit'),
                $request->query->get('offset')
            )
        );

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

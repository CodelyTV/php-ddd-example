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
    public function __construct(private QueryBus $queryBus)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $orderBy = $request->query->get('order_by');
        $order = $request->query->get('order');
        $limit  = $request->query->get('limit');
        $offset = $request->query->get('offset');

        /** @var BackofficeCoursesResponse $response */
        $response = $this->queryBus->ask(
            new SearchBackofficeCoursesByCriteriaQuery(
                (array) $request->query->get('filters'),
                null === $orderBy ? null : (string) $orderBy,
                null === $order ? null : (string) $order,
                null === $limit ? null : (int) $limit,
                null === $offset ? null : (int) $offset
            )
        );

        return new JsonResponse(
            map(
                fn (BackofficeCourseResponse $course) => [
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

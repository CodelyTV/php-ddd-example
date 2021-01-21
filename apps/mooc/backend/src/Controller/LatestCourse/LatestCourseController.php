<?php
declare(strict_types=1);

namespace CodelyTv\Apps\Mooc\Backend\Controller\LatestCourse;

use CodelyTv\Mooc\Courses\Application\FindLatest\LatestCourseQuery;
use CodelyTv\Mooc\Courses\Domain\Course;
use CodelyTv\Mooc\Courses\Domain\NotExistCourseException;
use CodelyTv\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class LatestCourseController extends ApiController
{
    public function __invoke(): JsonResponse
    {
        /** @var Course $course */
        $course = $this->ask(new LatestCourseQuery());

        return new JsonResponse($course, Response::HTTP_OK);
    }

    protected function exceptions(): array
    {
        return [
            NotExistCourseException::class => Response::HTTP_NOT_FOUND,
        ];
    }
}

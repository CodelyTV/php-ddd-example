<?php

namespace CodelyTv\Api\Controller\Course;

use CodelyTv\Api\Infrastructure\Controller\ApiController;
use CodelyTv\Context\Course\Module\Course\Application\Find\FindCourseQuery;
use CodelyTv\Context\Course\Module\Course\Domain\CourseNotFound;
use Symfony\Component\HttpFoundation\Response;

final class CourseGetController extends ApiController
{
    protected function exceptions(): array
    {
        return [
            CourseNotFound::class => Response::HTTP_NOT_FOUND,
        ];
    }

    public function __invoke(string $id)
    {
        return $this->ask(new FindCourseQuery($id));
    }
}

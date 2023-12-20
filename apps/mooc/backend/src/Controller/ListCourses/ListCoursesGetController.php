<?php

namespace CodelyTv\Apps\Mooc\Backend\Controller\ListCourses;

use CodelyTv\Mooc\Courses\Application\List\ListCoursesQuery;
use CodelyTv\Mooc\Courses\Application\List\ListCoursesResponse;
use CodelyTv\Mooc\Courses\Domain\Course;
use CodelyTv\Mooc\Courses\Domain\CourseCollection;
use CodelyTv\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ListCoursesGetController extends ApiController
{
    public function __invoke(Request $request): Response
    {
        /** @var ListCoursesResponse $response */
        $response = $this->ask(new ListCoursesQuery());

        return new JsonResponse(self::transformer($response->courses()));
    }

    protected function exceptions(): array
    {
        return [];
    }

    public static function transformer(CourseCollection $courseCollection): array
    {
        $res = [];

        /** @var Course $course */
        foreach ($courseCollection->courses() as $course)
        {
            $res[] = [
                'id' => $course->id()->value(),
                'name' => $course->name()->value(),
                'duration' => $course->duration()->value(),
            ];
        }
        return $res;
    }
}
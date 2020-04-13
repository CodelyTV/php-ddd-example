<?php

declare(strict_types=1);

namespace CodelyTv\Apps\Mooc\Backend\Controller\Courses;

use CodelyTv\Mooc\Courses\Application\FindAll\FindAllCoursesQuery;
use CodelyTv\Shared\Infrastructure\Symfony\ApiController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class CoursesGetController extends ApiController
{
    protected function exceptions(): array
    {
        return [];
    }

    public function __invoke(string $id, Request $request): Response
    {
        $allCoursesResponse = $this->ask(new FindAllCoursesQuery());

        //$content = $allCoursesResponse->toArray();

        return new Response(
            'try',
            Response::HTTP_FOUND);
    }
}
